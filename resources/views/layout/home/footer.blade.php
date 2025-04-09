<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">{{ $appset->name }}</h3>
                <p class="text-gray-400">{{ $appset->deskripsi }}</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('form-pengaduan') }}" class="hover:text-white transition">Buat Pengaduan</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Kontak</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        <span>{{ $appset->no_whatsapp }}</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>{{ $appset->email }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ $appset->name }}. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
