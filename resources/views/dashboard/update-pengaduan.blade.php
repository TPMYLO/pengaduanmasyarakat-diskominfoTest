@extends('layout.dashboard.app')
@section('title', 'Update Tanggapan')
@section('content')
    <div class="container-fluid">
        <x-dashboard.breadcrumbs title="Update Tanggapan" />

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengaduan.add', $pengaduan->id) }}" method="POST">
                            @csrf
                            <x-dashboard.select :label="'Status'" :id="'status'" :options="[
                                'menunggu' => 'Menunggu',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                            ]" :value="$pengaduan->status"
                                required />
                            <x-dashboard.text-area label="Tanggapan" id="tanggapan" placeholder="Tanggapan" :value="old('tanggapan')"
                                required />
                            <div class="button-footer mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
