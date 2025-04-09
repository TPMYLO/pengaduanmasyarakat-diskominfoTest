@extends('layout.home.app')
@section('title', 'Form Pengaduan Masyarakat')
@section('content')
    <div class="bg-blue-700 text-white py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Sampaikan Pengaduan Anda</h1>
            <p class="mt-2">Isi form pengaduan dengan lengkap dan jelas</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('add-pengaduan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Data Diri Pelapor</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nik" class="block text-gray-700 mb-2">NIK <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required
                                maxlength="16"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nik') border-red-500 @enderror"
                                placeholder="Masukkan NIK (16 digit)">
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nama" class="block text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="telp" class="block text-gray-700 mb-2">No. HP <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="telp" name="telp" value="{{ old('telp') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('telp') border-red-500 @enderror"
                                placeholder="Contoh: 08123456789">
                            @error('telp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                placeholder="Contoh: nama@email.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-gray-700 mb-2">Alamat <span
                                    class="text-red-500">*</span></label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-500 @enderror"
                                placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Detail Pengaduan</h2>

                    <div class="space-y-6">
                        <div>
                            <label for="judul" class="block text-gray-700 mb-2">Judul Pengaduan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror"
                                placeholder="Judul singkat dan jelas tentang pengaduan Anda">
                            @error('judul')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-gray-700 mb-2">Deskripsi Permasalahan <span
                                    class="text-red-500">*</span></label>
                            <textarea id="deskripsi" name="deskripsi" rows="6" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror"
                                placeholder="Jelaskan secara detail permasalahan yang ingin Anda laporkan">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bukti" class="block text-gray-700 mb-2">Bukti Pendukung <span
                                    class="text-red-500">*</span></label>
                            <input type="file" id="bukti" name="bukti" required
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bukti') border-red-500 @enderror"
                                accept="image/*,.pdf">
                            <p class="text-xs text-gray-500 mt-1">Upload bukti berupa foto atau file PDF (Maksimal 10MB)
                            </p>
                            @error('bukti')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-blue-600 text-white py-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Pengaduan Anda Penting</h2>
            <p class="text-lg mb-6">Terima kasih telah berpartisipasi dalam memperbaiki layanan publik</p>
            <a href="{{ route('home') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Kembali ke
                Halaman Utama</a>
        </div>
    </div>
@endsection
