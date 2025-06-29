@php
    use Illuminate\Support\Str;
@endphp

@foreach($pengumuman as $item)
    <i class="fas {{ $item->icon ?? 'info-circle' }} text-yellow-400 mr-3 text-2xl"></i>
    <span class="text-2xl font-medium">{{ Str::limit($item->konten, 120) }}</span>
    @if(!$loop->last)
        <span class="mx-8 text-2xl text-gray-300">|</span>
    @endif
@endforeach
