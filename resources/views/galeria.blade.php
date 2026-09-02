@extends('layouts.app')

@section('title', 'Galeria — Juari Eventos')

@section('content')

    @php
        $descricoes = [
            'casamentos' => 'Cerimônias e recepções personalizadas para o dia mais especial.',
            'festas-infantis' => 'Espaço lúdico e seguro para festas infantis inesquecíveis.',
            '15-anos' => 'Elegância e diversão para celebrar essa data especial.',
            'corporativo' => 'Estrutura completa para eventos e confraternizações empresariais.',
            'aniversarios' => 'Celebre mais um ano de vida com todo conforto.',
            'cha-de-bebe' => 'Momentos delicados para receber o novo integrante da família.',
            'formaturas' => 'Festas de formatura com estrutura completa para comemorar essa conquista.',
            'outros' => 'Outras celebrações que merecem um espaço à altura.',
        ];

        $galerias = \App\Models\Gallery::with(['photos' => fn ($q) => $q->where('publicada', true)->orderBy('ordem')])
            ->where('tipo', 'eventos')
            ->whereNotNull('categoria')
            ->orderBy('id')
            ->get()
            ->keyBy('categoria');

        $categoriasValidas = $galerias->keys()->all();
        $categoriaSelecionada = in_array(request('tipo'), $categoriasValidas, true) ? request('tipo') : ($categoriasValidas[0] ?? null);

        $capaGaleria = \App\Models\SiteImage::urlFor('galeria_capa');
    @endphp

    {{-- HERO --}}
    <section class="relative h-[50vh] min-h-[360px] bg-cover bg-center flex items-end {{ $capaGaleria ? '' : 'bg-graphite-light animate-pulse' }}"
             @if($capaGaleria) style="background-image: url('{{ $capaGaleria }}');" @endif>
        <div class="absolute inset-0 bg-gradient-to-t from-graphite/85 via-graphite/25 to-transparent"></div>
        @unless($capaGaleria)
            <div class="absolute inset-0 flex items-center justify-center text-graphite/40 text-xs">
                Capa da galeria
            </div>
        @endunless
        <div class="relative max-w-6xl mx-auto px-6 pb-12 text-center w-full">
            <p class="font-sans font-semibold text-sm tracking-[3px] text-terracotta mb-3">JUARI EVENTOS</p>
            <h1 class="font-display font-extrabold text-3xl md:text-4xl text-cream">Galeria</h1>
            <p class="text-cream/80 mt-3">Momentos reais celebrados no nosso espaço.</p>
        </div>
    </section>

    {{-- KICKER + TÍTULO --}}
    <div class="max-w-6xl mx-auto px-6 pt-12">
        <p class="font-sans font-semibold text-xs tracking-[3px] text-terracotta uppercase mb-2">Portfólio</p>
    </div>

    {{-- FILTROS --}}
    <div class="max-w-6xl mx-auto px-6">
        <div id="filtros" class="flex flex-wrap gap-2 border-b border-graphite/10 pb-6">
            @foreach ($galerias as $slug => $gallery)
                <button data-filter="{{ $slug }}"
                        class="filtro-btn px-4 py-2 rounded-full text-sm font-medium transition
                               {{ $slug === $categoriaSelecionada ? 'bg-terracotta text-cream' : 'bg-white border border-graphite/10 text-graphite/70 hover:border-terracotta' }}">
                    {{ $gallery->nome }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- CARTÕES --}}
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div id="galeria-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($galerias as $slug => $gallery)
                @forelse ($gallery->photos as $photo)
                    <div class="galeria-card rounded-lg overflow-hidden bg-white shadow-sm border border-graphite/5 transition hover:shadow-md hover:-translate-y-0.5 {{ $slug === $categoriaSelecionada ? '' : 'hidden' }}"
                         data-category="{{ $slug }}">
                        <div class="relative aspect-video bg-cover bg-center" style="background-image: url('{{ $photo->url() }}');">
                            <span class="absolute bottom-2 left-2 rounded-full bg-graphite/80 backdrop-blur px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-cream">
                                {{ Str::upper(Str::of($gallery->nome)->replace('15 Anos', '15 anos')) }}
                            </span>
                        </div>
                        @if ($photo->legenda)
                            <p class="px-4 py-3 text-sm text-graphite/70">{{ $photo->legenda }}</p>
                        @endif
                    </div>
                @empty
                    <div class="galeria-card rounded-lg overflow-hidden bg-white shadow-sm border border-graphite/5 {{ $slug === $categoriaSelecionada ? '' : 'hidden' }}"
                         data-category="{{ $slug }}">
                        <div class="relative aspect-video bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40">
                            Em breve
                        </div>
                        <div class="p-4">
                            <p class="font-display font-semibold text-sm text-graphite mb-1">{{ $gallery->nome }}</p>
                            <p class="text-xs text-graphite/60">{{ $descricoes[$slug] ?? '' }}</p>
                        </div>
                    </div>
                @endforelse
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botoes = document.querySelectorAll('.filtro-btn');
            const cartoes = document.querySelectorAll('.galeria-card');

            function selecionar(filtro, rolar) {
                botoes.forEach(function (b) {
                    const ativo = b.dataset.filter === filtro;
                    b.classList.toggle('bg-terracotta', ativo);
                    b.classList.toggle('text-cream', ativo);
                    b.classList.toggle('bg-white', !ativo);
                    b.classList.toggle('border', !ativo);
                    b.classList.toggle('border-graphite/10', !ativo);
                    b.classList.toggle('text-graphite/70', !ativo);
                });
                cartoes.forEach(function (cartao) {
                    cartao.classList.toggle('hidden', cartao.dataset.category !== filtro);
                });
                if (rolar) {
                    document.getElementById('filtros').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            botoes.forEach(function (botao) {
                botao.addEventListener('click', function () {
                    selecionar(botao.dataset.filter, true);
                });
            });
        });
    </script>

@endsection
