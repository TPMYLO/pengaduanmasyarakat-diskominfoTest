<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.index');
    }

    private function generateStatusBadge($status)
    {
        return match ($status) {
            'menunggu' => '<span class="badge bg-warning">Menunggu</span>',
            'diproses' => '<span class="badge bg-primary">Diproses</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'ditolak' => '<span class="badge bg-danger">Ditolak</span>',
            default => '<span class="badge bg-dark">' . $status . '</span>'
        };
    }

    public function pengaduanDatatables()
    {
        $pengaduan = Pengaduan::with('tanggapan')
            ->orderBy('created_at', 'desc')
            ->get();
        $data = [];

        foreach ($pengaduan as $key => $value) {
            $row = [
                'tracking_id' => $value->tracking_id,
                'judul' => $value->judul,
                'deskripsi' => Str::limit($value->deskripsi, 50),
                'nik' => $value->nik,
                'nama' => $value->nama . ' (' . $value->telp . ')',
                'email' => $value->email,
                'bukti_file' => '<a href="' . route('download-bukti', $value->tracking_id) . '" class="btn btn-sm btn-primary">Download</a>',
                'status' => $this->generateStatusBadge($value->status),
                'action' => '<div class="btn-group">
                    <a href="' . route('tanggapan.add', $value->id) . '" class="btn btn-primary btn-sm" type="button">
                        <i class="material-icons no-m fs-5">edit</i>
                    </a>
                </div>'
            ];

            $data[] = $row;
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['status', 'bukti_file', 'action'])
            ->toJson();
    }

    public function viewAddTanggapan($id)
    {
        $pengaduan = Pengaduan::with('tanggapan')
            ->where('id', $id)
            ->firstOrFail();

        return view('dashboard.update-pengaduan', compact('pengaduan'));
    }

    public function addTanggapan(Request $request)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'required',
        ], [
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status tidak valid',
            'tanggapan.required' => 'Tanggapan tidak boleh kosong',
        ]);

        try {
            DB::beginTransaction();
            $pengaduan = Pengaduan::findOrFail($request->id);
            $pengaduan->update([
                'status' => $request->status,
            ]);

            $pengaduan->tanggapan()->create([
                'pengaduans_id' => $pengaduan->id,
                'users_id' => auth()->user()->id,
                'tanggapan' => $request->tanggapan,
            ]);

            DB::commit();
            toast('Tanggapan berhasil ditambahkan', 'success');
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            DB::rollBack();
            toast('Tanggapan gagal ditambahkan: ' . $th->getMessage(), 'error');
            return redirect()->route('dashboard')
                ->with('error', 'Tanggapan gagal ditambahkan: ' . $th->getMessage())
                ->withInput();
        }
    }
}
