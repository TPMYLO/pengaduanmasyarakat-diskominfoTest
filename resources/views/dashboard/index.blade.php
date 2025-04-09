@extends('layout.dashboard.app')
@section('title', 'Dashboard')
@push('css')
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <x-dashboard.breadcrumbs title="Dashboard" />

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Pengaduan</h5>
            </div>
            <div class="card-body">
                <table id="datatable1" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tracking</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $(document).ready(function() {
            $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ajax: "{{ route('pengaduan.datatables') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: true,
                        sortable: true
                    },
                    {
                        data: 'tracking_id'
                    },
                    {
                        data: 'judul'
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'bukti_file'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        searchable: true,
                        sortable: true,
                    }
                ],
            });
        });
    </script>
@endpush
