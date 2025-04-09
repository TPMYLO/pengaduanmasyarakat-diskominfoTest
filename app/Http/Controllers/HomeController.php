<?php

namespace App\Http\Controllers;

use App\Models\Appsettings;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function viewHome()
    {
        $appset = Appsettings::first();
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')
            ->paginate(3);

        return view('home.index', compact('appset', 'pengaduans'));
    }

    public function viewFormPengaduan()
    {
        return view('home.form-pengaduan');
    }

    public function addPengaduan(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'bukti' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:10048',
        ], [
            'nik.required' => 'NIK tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'telp.required' => 'No Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'bukti.required' => 'Bukti tidak boleh kosong',
            'bukti.file' => 'Bukti harus berupa file',
            'bukti.mimes' => 'Bukti harus berupa file dengan format jpeg, png, jpg, gif, pdf',
            'bukti.max' => 'Bukti tidak boleh lebih dari 10MB',
        ]);

        try {
            $buktiPath = $request->file('bukti')->store('bukti');
            $trackingId = 'TRK-' . Str::random(8);

            Pengaduan::create([
                'tracking_id' => $trackingId,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'telp' => $request->telp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'bukti_file' => $buktiPath,
                'status' => 'menunggu',
            ]);

            return redirect()->route('form-pengaduan')
                ->with('success', 'Pengaduan berhasil dikirim. Nomor Tracking Anda: ' . $trackingId);
        } catch (\Throwable $th) {
            return redirect()->route('form-pengaduan')
                ->with('error', 'Pengaduan gagal dikirim: ' . $th->getMessage())
                ->withInput();
        }
    }

    public function viewTrackingPengaduan()
    {
        return view('home.track');
    }

    public function trackPengaduan(Request $request, $tracking_id = null)
    {
        if (!$tracking_id) {
            $tracking_id = $request->query('tracking_id');
        }

        $pengaduan = null;

        if ($tracking_id) {
            $pengaduan = Pengaduan::with('tanggapan')
                ->where('tracking_id', $tracking_id)
                ->first();
        }

        return view('home.track', compact('pengaduan'));
    }

    public function downloadBukti($tracking_id)
    {
        $pengaduan = Pengaduan::where('tracking_id', $tracking_id)->firstOrFail();
        $filePath = storage_path('app/public/' . $pengaduan->bukti_file);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, 'bukti_' . $tracking_id . '_' . pathinfo($pengaduan->bukti_file, PATHINFO_BASENAME));
    }
}
