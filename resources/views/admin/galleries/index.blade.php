<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display font-extrabold text-2xl text-graphite">Galeria</h1>
        <p class="text-sm text-graphite/60 mt-1">Adicione ou exclua fotos por categoria. As mudanças aparecem no site na hora.</p>
    </x-slot>

    @error('foto')
        <div class="mb-6 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">{{ $message }}</div>
    @enderror

    <div class="space-y-10">
        @foreach ($galleries as $gallery)
            <section class="rounded-xl border border-graphite/10 bg-white p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-display font-bold text-lg text-graphite">{{ $gallery->nome }}</h2>
                    <span class="text-xs text-graphite/50">{{ $gallery->photos->count() }} foto(s)</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3 mb-5">
                    @forelse ($gallery->photos as $photo)
                        <div class="relative group aspect-square rounded-md overflow-hidden bg-graphite-light/10">
                            <img src="{{ $photo->url() }}" alt="" class="w-full h-full object-cover">
                            <form method="POST" action="{{ route('admin.galleries.destroy', $photo) }}"
                                  onsubmit="return confirm('Excluir esta foto?');"
                                  class="absolute inset-0 flex items-center justify-center bg-graphite/60 opacity-0 group-hover:opacity-100 transition">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-medium rounded-md bg-white/90 text-red-600 px-3 py-1.5 hover:bg-white transition">Excluir</button>
                            </form>
                        </div>
                    @empty
                        <p class="col-span-full text-xs text-graphite/40">Nenhuma foto nessa categoria ainda.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-3">
                    @csrf
                    <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                    <input type="file" name="foto" accept="image/*" required
                           class="text-sm text-graphite/70 file:mr-3 file:rounded-md file:border-0 file:bg-graphite/5 file:px-3 file:py-2 file:text-xs file:font-medium hover:file:bg-graphite/10">
                    <button type="submit" class="text-xs font-medium rounded-md bg-terracotta text-cream px-4 py-2 hover:bg-terracotta-dark transition">Adicionar foto</button>
                </form>
            </section>
        @endforeach
    </div>
</x-app-layout>
