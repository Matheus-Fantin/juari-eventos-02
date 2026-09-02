@extends('layouts.app')

@section('title', 'Galeria — Juari Eventos')

@section('content')

    @php
        $categorias = [
            'casamentos' => ['nome' => 'Casamentos', 'descricao' => 'Cerimônias e recepções personalizadas para o dia mais especial.'],
            'festas-infantis' => ['nome' => 'Festas Infantis', 'descricao' => 'Espaço lúdico e seguro para festas infantis inesquecíveis.'],
            '15-anos' => ['nome' => '15 Anos', 'descricao' => 'Elegância e diversão para celebrar essa data especial.'],
            'corporativo' => ['nome' => 'Corporativo', 'descricao' => 'Estrutura completa para eventos e confraternizações empresariais.'],
            'aniversarios' => ['nome' => 'Aniversários', 'descricao' => 'Celebre mais um ano de vida com todo conforto.'],
            'cha-de-bebe' => ['nome' => 'Chá de Bebê', 'descricao' => 'Momentos delicados para receber o novo integrante da família.'],
            'formaturas' => ['nome' => 'Formaturas', 'descricao' => 'Festas de formatura com estrutura completa para comemorar essa conquista.'],
        ];
        $primeiraCategoria = array_key_first($categorias);
        $capaGaleria = 'images/galeria/capa.jpg';
        $existeCapaGaleria = file_exists(public_path($capaGaleria));
    @endphp

    {{-- HERO --}}
    <section class="relative h-[50vh] min-h-[360px] bg-cover bg-center flex items-end {{ $existeCapaGaleria ? '' : 'bg-graphite-light animate-pulse' }}"
             @if($existeCapaGaleria) style="background-image: url('{{ asset($capaGaleria) }}');" @endif>
        <div class="absolute inset-0 bg-gradient-to-t from-graphite/85 via-graphite/25 to-transparent"></div>
        @unless($existeCapaGaleria)
            <div class="absolute inset-0 flex items-center justify-center text-graphite/40 text-xs">
                {{ $capaGaleria }}
            </div>
        @endunless
        <div class="relative max-w-6xl mx-auto px-6 pb-12 text-center w-full">
            <p class="font-display font-semibold text-sm tracking-[3px] text-terracotta mb-3">JUARI EVENTOS</p>
            <h1 class="font-display font-extrabold text-3xl md:text-4xl text-cream">Galeria</h1>
            <p class="text-cream/80 mt-3">Momentos reais celebrados no nosso espaço.</p>
        </div>
    </section>

    {{-- KICKER + TÍTULO --}}
    <div class="max-w-6xl mx-auto px-6 pt-12">
        <p class="font-display font-semibold text-xs tracking-[3px] text-terracotta uppercase mb-2">Portfólio</p>
    </div>

    {{-- FILTROS --}}
    <div class="max-w-6xl mx-auto px-6">
        <div id="filtros" class="flex flex-wrap gap-2 border-b border-graphite/10 pb-6">
            @foreach ($categorias as $slug => $info)
                <button data-filter="{{ $slug }}"
                        class="filtro-btn px-4 py-2 rounded-full text-sm font-medium transition
                               {{ $slug === $primeiraCategoria ? 'bg-terracotta text-cream' : 'bg-white border border-graphite/10 text-graphite/70 hover:border-terracotta' }}">
                    {{ $info['nome'] }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- CARTÕES --}}
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div id="galeria-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($categorias as $slug => $info)
                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $caminhoRelativo = 'images/galeria/' . $slug . '-' . $i . '.jpg';
                        $existe = file_exists(public_path($caminhoRelativo));
                    @endphp
                    <div class="galeria-card rounded-lg overflow-hidden bg-white shadow-sm border border-graphite/5 transition hover:shadow-md hover:-translate-y-0.5 {{ $slug === $primeiraCategoria ? '' : 'hidden' }}"
                         data-category="{{ $slug }}">
                        <div class="relative aspect-video {{ $existe ? 'bg-cover bg-center' : 'bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40' }}"
                             @if($existe) style="background-image: url('{{ asset($caminhoRelativo) }}');" @endif>
                            @unless($existe)
                                Em breve
                            @endunless

                            <span class="absolute bottom-2 left-2 rounded-full bg-graphite/80 backdrop-blur px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-cream">
                                {{ Str::upper(Str::of($info['nome'])->replace('15 Anos', '15 anos')) }}
                            </span>
                        </div>
                        <div class="p-4">
                            <p class="font-display font-semibold text-sm text-graphite mb-1">{{ $info['nome'] }}</p>
                            <p class="text-xs text-graphite/60">{{ $info['descricao'] }}</p>
                        </div>
                    </div>
                @endfor
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botoes = document.querySelectorAll('.filtro-btn');
            const cartoes = document.querySelectorAll('.galeria-card');

            botoes.forEach(function (botao) {
                botao.addEventListener('click', function () {
                    const filtro = botao.dataset.filter;

                    botoes.forEach(function (b) {
                        b.classList.remove('bg-terracotta', 'text-cream');
                        b.classList.add('bg-white', 'border', 'border-graphite/10', 'text-graphite/70');
                    });
                    botao.classList.add('bg-terracotta', 'text-cream');
                    botao.classList.remove('bg-white', 'border', 'border-graphite/10', 'text-graphite/70');

                    cartoes.forEach(function (cartao) {
                        cartao.classList.toggle('hidden', cartao.dataset.category !== filtro);
                    });

                    document.getElementById('filtros').scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });
        });
    </script>

@endsection