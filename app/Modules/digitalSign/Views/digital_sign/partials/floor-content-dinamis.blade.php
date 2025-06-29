<div class="info-card rounded-xl p-6 shadow-lg transition hover:scale-105 bg-white/90 min-h-[150px]">
    <div class="text-gray-700 font-poppins">
        <h3 class="font-bold text-4xl mb-4 text-gray-800 text-center">Informasi Ruangan</h3>
        <div class="w-full h-1 bg-gray-200 mb-4 rounded-full"></div>

        @if(count($ruangan))
            <ul class="list-decimal pl-5 space-y-2 text-left font-semibold text-lg">
                @foreach($ruangan as $item)
                    <li>{{ strtoupper($item->nama) }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-center text-gray-500 font-semibold">Tidak ada ruangan aktif.</p>
        @endif
    </div>
</div>
