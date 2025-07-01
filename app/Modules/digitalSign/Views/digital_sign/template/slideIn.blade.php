<div class="slide w-full h-full flex p-8 relative" id="slide-{{ $index }}" style="background: url('bg2.png') center center / cover no-repeat; aspect-ratio:9/16; max-width:100vw; max-height:100vh;">
    <div>
        <img src="/logobaru.png" alt="Logo UNNES" class="h-36 slidein">
        <h1 class="text-[96px] font-bold slidein">{{ $slide->heading }}</h1>
        <h2 class="text-[72px] -mt-10 font-semibold slidein">{{ $slide->subheading }}</h2>

        @if (!empty($slide->gambar_tokoh))
            <img src="{{ asset("storage/{$slide->gambar_tokoh}") }}" alt="{{ $slide->nama_tokoh }}" class="h-[1100px] object-cover ml-8 rounded-xl absolute bottom-[300px] right-0 slidein">
        @endif

        <div class="absolute min-h-[125px] rounded-l-full pl-16 p-4 w-[80%] bg-red-500 right-0 bottom-[145px] slidein">
            <div class="font-bold text-[75px]">{{ $slide->nama_tokoh }}</div>
            <div class=" text-[50px] -mt-4">{{ $slide->jabatan_tokoh }}</div>
        </div>
    </div>
</div>
