@extends('layout.home.app')
@section('title', $appset->slogan)
@section('content')
    <div class="bg-blue-700 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Suara Anda, Perubahan Bersama</h1>
            <p class="text-xl mb-8">Platform pengaduan dan aspirasi masyarakat untuk Indonesia yang lebih baik</p>
            <a href="{{ route('form-pengaduan') }}"
                class="bg-yellow-500 text-blue-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition">Buat
                Pengaduan</a>
            <a href="{{ route('cari') }}"
                class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-400 transition">Cari
                Pengaduan</a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">Timeline Pengaduan Terbaru</h2>
        <div class="max-w-3xl mx-auto">
            <div class="space-y-6">
                @forelse($pengaduans as $pengaduan)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between items-start">
                            <div>
                                @if ($pengaduan->status == 'menunggu')
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Menunggu</span>
                                @elseif ($pengaduan->status == 'diproses')
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Diproses</span>
                                @elseif ($pengaduan->status == 'selesai')
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai</span>
                                @elseif ($pengaduan->status == 'ditolak')
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Ditolak</span>
                                @endif
                            </div>
                            <span class="text-gray-500 text-sm">{{ $pengaduan->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-semibold mt-3 mb-2">{{ $pengaduan->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($pengaduan->deskripsi, 200) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <span class="font-semibold">Pelapor:</span> {{ substr($pengaduan->nama, 0, 3) }}***
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200">
                            @if ($pengaduan->tanggapan->count() > 0)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                                        <i class="fas fa-reply text-blue-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-gray-900">Tanggapan dari Admin</p>
                                        <p class="text-sm text-gray-600">{{ $pengaduan->tanggapan->last()->tanggapan }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $pengaduan->tanggapan->last()->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-center text-gray-500 italic">Belum ada tanggapan dari instansi
                                    terkait</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <p class="text-gray-600">Belum ada pengaduan yang ditampilkan</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 flex justify-center">
                @if ($pengaduans->hasPages())
                    <nav class="inline-flex rounded-md shadow">
                        @if ($pengaduans->onFirstPage())
                            <span
                                class="py-2 px-4 bg-white border border-gray-300 text-gray-400 rounded-l-md cursor-default">Sebelumnya</span>
                        @else
                            <a href="{{ $pengaduans->previousPageUrl() }}"
                                class="py-2 px-4 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 rounded-l-md">Sebelumnya</a>
                        @endif

                        @foreach ($pengaduans->getUrlRange(1, $pengaduans->lastPage()) as $page => $url)
                            @if ($page == $pengaduans->currentPage())
                                <span
                                    class="py-2 px-4 bg-blue-600 border border-blue-600 text-white hover:bg-blue-700">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="py-2 px-4 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($pengaduans->hasMorePages())
                            <a href="{{ $pengaduans->nextPageUrl() }}"
                                class="py-2 px-4 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 rounded-r-md">Selanjutnya</a>
                        @else
                            <span
                                class="py-2 px-4 bg-white border border-gray-300 text-gray-400 rounded-r-md cursor-default">Selanjutnya</span>
                        @endif
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-blue-600 text-white py-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Punya Pengaduan atau Aspirasi?</h2>
            <p class="text-lg mb-6">Sampaikan pengaduan Anda dan ikut berpartisipasi dalam perbaikan layanan publik</p>
            <a href="{{ route('form-pengaduan') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Buat
                Pengaduan Sekarang</a>
        </div>
    </div>
@endsection
