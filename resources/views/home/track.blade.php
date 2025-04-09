@extends('layout.home.app')
@section('title', 'Lacak Pengaduan')
@section('content')
    <div class="bg-blue-700 text-white py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Lacak Status Pengaduan</h1>
            <p class="mt-2">Masukkan nomor tracking ID untuk melihat status pengaduan Anda</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <form action="{{ route('cari-pengaduan') }}" method="GET">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-grow">
                            <label for="tracking_id" class="block text-gray-700 mb-2 font-semibold">Nomor Tracking
                                ID</label>
                            <input type="text" id="tracking_id" name="tracking_id" value="{{ request('tracking_id') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Contoh: TRK-ABC12345" required>
                        </div>
                        <div class="md:self-end">
                            <button type="submit"
                                class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Lacak Pengaduan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if (isset($pengaduan))
                @if ($pengaduan)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="mb-4 pb-3 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Detail Pengaduan</h2>
                            <p class="text-sm text-gray-500 mt-1">Tracking ID: {{ $pengaduan->tracking_id }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Pengaduan:</p>
                                <p class="font-semibold">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status:</p>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($pengaduan->status == 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($pengaduan->status == 'diproses') bg-blue-100 text-blue-800
                                    @elseif($pengaduan->status == 'selesai') bg-green-100 text-green-800
                                    @elseif($pengaduan->status == 'ditolak') bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Pelapor:</p>
                                <p class="font-semibold">{{ substr($pengaduan->nama, 0, 3) }}***</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm text-gray-500">Judul:</p>
                            <p class="font-semibold">{{ $pengaduan->judul }}</p>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm text-gray-500">Deskripsi:</p>
                            <p class="mt-1">{{ $pengaduan->deskripsi }}</p>
                        </div>

                        @if ($pengaduan->bukti_file)
                            <div class="mb-6">
                                <p class="text-sm text-gray-500 mb-2">Bukti:</p>
                                <a href="{{ route('download-bukti', ['tracking_id' => $pengaduan->tracking_id]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-download mr-2"></i>
                                    Download Bukti
                                </a>
                            </div>
                        @endif

                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-6">Timeline Status Pengaduan</h3>
                            <div class="relative pl-8 pb-4">
                                <div class="absolute left-0 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                                <div class="relative mb-6 pl-6 pb-4 border-b border-gray-100">
                                    <div
                                        class="absolute left-0 top-1 w-4 h-4 -ml-2.5 rounded-full
                                        @if ($pengaduan->status == 'menunggu') bg-yellow-500
                                        @elseif(in_array($pengaduan->status, ['diproses', 'selesai', 'ditolak'])) bg-blue-500 @endif
                                        shadow-md z-10">
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center mb-1">
                                            <span class="text-sm font-semibold text-gray-800 mr-2">Pengaduan Diterima</span>
                                            <span class="text-xs text-gray-500">
                                                ({{ $pengaduan->created_at->format('d M Y, H:i') }})
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">Pengaduan telah diterima dan sedang menunggu
                                            verifikasi dari admin.
                                            Silahkan menunggu proses selanjutnya.</p>
                                    </div>
                                </div>

                                @if (in_array($pengaduan->status, ['diproses', 'selesai', 'ditolak']))
                                    <div class="relative mb-6 pl-6 pb-4 border-b border-gray-100">
                                        <div
                                            class="absolute left-0 top-1 w-4 h-4 -ml-2.5 rounded-full
                                            @if ($pengaduan->status == 'ditolak') bg-red-500
                                            @elseif(in_array($pengaduan->status, ['diproses', 'selesai'])) bg-blue-500 @endif
                                            shadow-md z-10">
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex items-center mb-1">
                                                <span class="text-sm font-semibold text-gray-800 mr-2">
                                                    @if ($pengaduan->status == 'ditolak')
                                                        Pengaduan Ditolak
                                                    @else
                                                        Pengaduan Diproses
                                                    @endif
                                                </span>
                                                <span class="text-xs text-gray-500">
                                                    ({{ $pengaduan->updated_at->format('d M Y, H:i') }})
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600">
                                                @if ($pengaduan->status == 'ditolak')
                                                    Mohon maaf, pengaduan Anda tidak dapat diproses lebih lanjut.
                                                @else
                                                    Pengaduan sedang dalam proses penanganan oleh tim kami.
                                                    Kami akan segera menindaklanjuti laporan Anda.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if ($pengaduan->status == 'selesai')
                                    <div class="relative pl-6">
                                        <div
                                            class="absolute left-0 top-1 w-4 h-4 -ml-2.5 rounded-full bg-green-500 shadow-md z-10">
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex items-center mb-1">
                                                <span class="text-sm font-semibold text-gray-800 mr-2">Pengaduan
                                                    Selesai</span>
                                                <span class="text-xs text-gray-500">
                                                    ({{ $pengaduan->updated_at->format('d M Y, H:i') }})
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600">Pengaduan telah ditindaklanjuti dan dinyatakan
                                                selesai.
                                                Terima kasih atas partisipasi Anda dalam perbaikan layanan publik.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($pengaduan->tanggapan->count() > 0)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold mb-4">Tanggapan Admin</h3>
                                @foreach ($pengaduan->tanggapan as $tanggapan)
                                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                                                <i class="fas fa-reply text-blue-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-semibold text-gray-900">Admin</p>
                                                <p class="text-sm text-gray-600">{{ $tanggapan->tanggapan }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $tanggapan->created_at->format('d M Y, H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="bg-white p-6 rounded-lg shadow-md text-center">
                        <div class="text-yellow-500 mb-3">
                            <i class="fas fa-exclamation-triangle text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Pengaduan Tidak Ditemukan</h3>
                        <p class="text-gray-600">Maaf, tidak ada pengaduan dengan tracking ID tersebut. Mohon periksa
                            kembali nomor tracking ID Anda.</p>
                    </div>
                @endif
            @else
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-center py-8">
                        <div class="text-blue-500 mb-3">
                            <i class="fas fa-search text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Lacak Status Pengaduan Anda</h3>
                        <p class="text-gray-600">Masukkan nomor tracking ID pada form di atas untuk melihat status dan
                            detail pengaduan Anda.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-blue-600 text-white py-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Belum Membuat Pengaduan?</h2>
            <p class="text-lg mb-6">Sampaikan pengaduan Anda dan ikut berpartisipasi dalam perbaikan layanan publik</p>
            <a href="{{ route('form-pengaduan') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Buat
                Pengaduan Sekarang</a>
        </div>
    </div>
@endsection
