@extends('layouts.app')

@section('title', 'Juari Eventos — Transformando momentos em memórias inesquecíveis')

@section('content')

    {{-- HERO --}}
    @php
        $capaHome = \App\Models\SiteImage::urlFor('home_capa');
    @endphp
    <section class="relative h-[65vh] min-h-[460px] bg-cover bg-center flex items-end {{ $capaHome ? '' : 'bg-graphite-light animate-pulse' }}"
             @if($capaHome) style="background-image: url('{{ $capaHome }}');" @endif>
        <div class="absolute inset-0 bg-gradient-to-t from-graphite/90 via-graphite/30 to-transparent"></div>
        @unless($capaHome)
            <div class="absolute inset-0 flex items-center justify-center text-graphite/40 text-xs">
                Capa da tela inicial
            </div>
        @endunless
        <div class="relative max-w-6xl mx-auto px-6 pb-12 text-center w-full">
            <p class="font-sans font-semibold text-sm tracking-[3px] text-terracotta mb-3">SERTANÓPOLIS · PR</p>
            <h1 class="font-display font-extrabold text-4xl md:text-5xl text-cream mb-3">
                JUARI <span class="text-cream/75">EVENTOS</span>
            </h1>
            <p class="text-cream/80 max-w-xl mx-auto mb-8">
                Transformando momentos em memórias inesquecíveis.
            </p>
            <div class="flex items-center justify-center gap-4 mb-10">
                <a href="#orcamento" class="rounded-md bg-terracotta text-cream px-6 py-3 text-sm font-medium hover:bg-terracotta-dark transition">
                    Solicitar orçamento
                </a>
                <a href="{{ url('/galeria') }}" class="rounded-md border border-cream/50 text-cream px-6 py-3 text-sm font-medium hover:border-cream transition">
                    Ver galeria
                </a>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-cream/90 text-sm border-t border-cream/15 pt-6">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Até 200 convidados
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="7" width="18" height="13" rx="2"></rect><path d="M3 11h18"></path><path d="M8 3v4M16 3v4"></path>
                    </svg>
                    Área coberta e externa
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 6-9 12-9 12S3 16 3 10a9 9 0 0 1 18 0Z"></path><circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Fácil acesso
                </div>
            </div>
        </div>
    </section>

    {{-- TIPOS DE EVENTO --}}
    @php
        $tiposEvento = [
            'casamentos' => ['nome' => 'Casamentos', 'icone' => '<circle cx="9" cy="14" r="5"/><circle cx="15" cy="14" r="5"/>'],
            'festas-infantis' => ['nome' => 'Festas Infantis', 'icone' => '<ellipse cx="12" cy="9" rx="6" ry="7"/><path d="M12 16 L10.5 18 L13.5 19 L11 21"/>'],
            '15-anos' => ['nome' => '15 Anos', 'icone' => '<path d="M4 17 L4 12 L9 16 L12 8 L15 16 L20 12 L20 17 Z"/><circle cx="12" cy="6" r="1.4"/>'],
            'corporativo' => ['nome' => 'Corporativo', 'icone' => '<rect x="3.5" y="8" width="17" height="11" rx="1.6"/><path d="M9 8 V6.2 A1.4 1.4 0 0 1 10.4 4.8 h3.2 A1.4 1.4 0 0 1 15 6.2 V8"/><path d="M3.5 12.5 h17"/>'],
            'aniversarios' => ['nome' => 'Aniversários', 'icone' => '<rect x="4" y="12" width="16" height="8" rx="1.4"/><path d="M4 16 h16"/><path d="M9 12 V9 M12 12 V9 M15 12 V9"/><circle cx="9" cy="6" r="0.9" fill="currentColor" stroke="none"/><circle cx="12" cy="6" r="0.9" fill="currentColor" stroke="none"/><circle cx="15" cy="6" r="0.9" fill="currentColor" stroke="none"/>'],
            'cha-de-bebe' => ['nome' => 'Chá de Bebê', 'icone' => '<rect x="7" y="9" width="8" height="12" rx="2.4"/><path d="M9.5 9 V6.6 h5 V9"/><path d="M10.3 4.6 h3.4 v2 h-3.4 z"/><path d="M7 14 h8"/>'],
            'formaturas' => ['nome' => 'Formaturas', 'icone' => '<path d="M2 10 L12 5 L22 10 L12 15 Z"/><path d="M6 12 V16 c0 1.7 2.7 3 6 3 s6 -1.3 6 -3 V12"/><path d="M22 10 v5.5"/>'],
            'outros' => ['nome' => 'Outros', 'icone' => '<path d="M12 3 V9 M12 15 V21 M3 12 H9 M15 12 H21 M5.6 5.6 L9.5 9.5 M14.5 14.5 L18.4 18.4 M18.4 5.6 L14.5 9.5 M9.5 14.5 L5.6 18.4"/>'],
        ];
    @endphp
    <section id="eventos" class="max-w-6xl mx-auto px-6 py-16">
        <div class="flex items-center gap-3 mb-2">
            <p class="font-sans font-semibold text-xs tracking-[3px] text-terracotta uppercase whitespace-nowrap">Tipos de evento</p>
            <span class="flex-1 h-px bg-graphite/10"></span>
        </div>
        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-2">Encontre a celebração que combina com você</h2>
        <p class="text-graphite/60 text-sm mb-8">Escolha um tipo para ver o portfólio correspondente na galeria.</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($tiposEvento as $slug => $tipo)
                <a href="{{ url('/galeria') }}?tipo={{ $slug }}"
                   class="group rounded-lg bg-white shadow-sm border border-graphite/5 p-6 flex flex-col items-center gap-3 text-center transition hover:shadow-md hover:-translate-y-0.5 hover:border-terracotta">
                    <span class="h-11 w-11 rounded-full bg-terracotta/10 text-terracotta flex items-center justify-center transition group-hover:bg-terracotta group-hover:text-cream">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            {!! $tipo['icone'] !!}
                        </svg>
                    </span>
                    <span class="text-sm font-medium text-graphite">{{ $tipo['nome'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ESTRUTURA --}}
    <section id="estrutura" class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <div class="flex items-center gap-3 mb-2">
            <p class="font-sans font-semibold text-xs tracking-[3px] text-terracotta uppercase whitespace-nowrap">Estrutura do Espaço</p>
            <span class="flex-1 h-px bg-graphite/10"></span>
        </div>
        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-8">
            Tudo pronto para o seu evento, do início ao fim
        </h2>

        @php
            $estruturaHome = [
                ['nome' => 'Salão Amplo', 'icone' => '<rect x="3" y="6" width="18" height="13" rx="1.4"/><path d="M3 11 h18 M8 19 V11 M16 19 V11"/>'],
                ['nome' => 'Área Coberta', 'icone' => '<path d="M2.5 10 L12 4 L21.5 10"/><path d="M5 10 V19 H19 V10"/>'],
                ['nome' => 'Espaço Kids', 'icone' => '<circle cx="12" cy="6.5" r="2.6"/><path d="M6 19 c0-4 2.7-6.4 6-6.4s6 2.4 6 6.4"/><path d="M9 19 v-3 M15 19 v-3"/>'],
                ['nome' => 'Ar-condicionado', 'icone' => '<rect x="3" y="5" width="18" height="7" rx="1.6"/><path d="M6 15 v3 M10 15 v4.5 M14 15 v3 M18 15 v4.5"/>'],
                ['nome' => 'Fogão a Lenha', 'icone' => '<path d="M12 3 c1.6 2.2 2.2 3.6 2.2 5 a2.2 2.2 0 1 1-4.4 0 c0-.8.3-1.5.8-2.2"/><path d="M6 21 c0-4.4 2.7-7 6-7s6 2.6 6 7"/>'],
                ['nome' => 'Churrasqueira', 'icone' => '<ellipse cx="12" cy="8" rx="7" ry="3"/><path d="M5 8 v4 c0 1.7 3.1 3 7 3s7-1.3 7-3V8"/><path d="M9 15 l-2 6 M15 15 l2 6"/>'],
                ['nome' => 'Cozinha de Apoio', 'icone' => '<path d="M5 3 v7 M8 3 v7 M5 7 h3 M6.5 10 v11"/><path d="M15 3 c-2 0-3 2-3 4.5 s1 4 3 4 M15 3 v18"/>'],
                ['nome' => 'Banheiros', 'icone' => '<circle cx="8" cy="5" r="1.8"/><path d="M8 8 v12 M5 12 h6"/><circle cx="17" cy="5" r="1.8" fill="currentColor" stroke="none"/><path d="M17 8 c-2 0-2.6 1.6-2.6 3 v3 h5.2 v-3 c0-1.4-.6-3-2.6-3 Z M17 14 v6"/>'],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 border border-graphite/10 rounded-lg overflow-hidden divide-x divide-y divide-graphite/10 md:divide-y-0">
            @foreach ($estruturaHome as $item)
                <div class="flex flex-col items-center justify-center text-center gap-2.5 px-4 py-8 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        {!! $item['icone'] !!}
                    </svg>
                    <span class="text-sm text-graphite/80">{{ $item['nome'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- GALERIA (prévia) --}}
    @php
        $fotosPreview = \App\Models\Photo::where('publicada', true)
            ->whereHas('gallery', fn ($q) => $q->where('tipo', 'eventos'))
            ->latest()->take(8)->get();
    @endphp
    <section class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="font-sans font-semibold text-sm tracking-[3px] text-terracotta uppercase">Galeria</h2>
            <a href="{{ url('/galeria') }}" class="text-sm text-terracotta hover:text-terracotta-dark transition">Ver todas as fotos →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @forelse ($fotosPreview as $foto)
                <a href="{{ url('/galeria') }}" class="aspect-square rounded-md overflow-hidden bg-cover bg-center block hover:opacity-90 transition"
                   style="background-image: url('{{ $foto->url() }}');"></a>
            @empty
                @for ($i = 1; $i <= 8; $i++)
                    <div class="aspect-square rounded-md bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40">
                        Em breve
                    </div>
                @endfor
            @endforelse
        </div>
    </section>

    {{-- GASTRONOMIA --}}
    @php
        $galeriasGastronomia = \App\Models\Gallery::with(['photos' => fn ($q) => $q->where('publicada', true)->orderBy('ordem')])
            ->where('tipo', 'gastronomia')
            ->orderBy('id')
            ->get();
        $primeiraGastronomia = $galeriasGastronomia->first()?->categoria;
    @endphp
    <section id="gastronomia" class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <h2 class="font-sans font-semibold text-sm tracking-[3px] text-terracotta uppercase mb-3">Gastronomia</h2>
        <p class="text-graphite/70 text-sm max-w-xl mb-6">
            Sabores que completam a experiência do seu evento, com opções para todos os estilos de celebração.
        </p>

        @if ($galeriasGastronomia->count() > 1)
            <div id="gastronomia-filtros" class="flex flex-wrap gap-2 mb-6">
                @foreach ($galeriasGastronomia as $galeria)
                    <button data-filter="{{ $galeria->categoria }}"
                            class="gastronomia-filtro-btn px-4 py-2 rounded-full text-sm font-medium transition
                                   {{ $galeria->categoria === $primeiraGastronomia ? 'bg-terracotta text-cream' : 'bg-white border border-graphite/10 text-graphite/70 hover:border-terracotta' }}">
                        {{ $galeria->nome }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @forelse ($galeriasGastronomia as $galeria)
                @forelse ($galeria->photos as $foto)
                    <div class="gastronomia-card aspect-square rounded-lg overflow-hidden bg-cover bg-center {{ $galeria->categoria === $primeiraGastronomia ? '' : 'hidden' }}"
                         data-category="{{ $galeria->categoria }}" style="background-image: url('{{ $foto->url() }}');"></div>
                @empty
                    <div class="gastronomia-card aspect-square rounded-lg overflow-hidden bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40 {{ $galeria->categoria === $primeiraGastronomia ? '' : 'hidden' }}"
                         data-category="{{ $galeria->categoria }}">
                        Em breve
                    </div>
                @endforelse
            @empty
                @for ($i = 1; $i <= 4; $i++)
                    <div class="aspect-square rounded-lg bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40">Em breve</div>
                @endfor
            @endforelse
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const botoes = document.querySelectorAll('.gastronomia-filtro-btn');
                const cartoes = document.querySelectorAll('.gastronomia-card');
                botoes.forEach(function (botao) {
                    botao.addEventListener('click', function () {
                        const filtro = botao.dataset.filter;
                        botoes.forEach(function (b) {
                            const ativo = b === botao;
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
                    });
                });
            });
        </script>
        <a href="{{ url('/sobre') }}#gastronomia"
           class="inline-flex items-center gap-2 text-sm font-medium text-terracotta hover:text-terracotta-dark transition">
            Ver cardápios completos
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M13 6l6 6-6 6"></path>
            </svg>
        </a>
    </section>

    {{-- COMO FUNCIONA --}}
    <section class="bg-cream border-t border-graphite/10">
        <div class="max-w-6xl mx-auto px-6 py-16">
            <h2 class="font-sans font-semibold text-sm tracking-[3px] text-terracotta uppercase text-center mb-2">Simples e transparente</h2>
            <p class="font-display font-extrabold text-2xl md:text-3xl text-graphite text-center mb-12">Do primeiro contato ao dia do evento</p>

            <div class="flex flex-col md:grid md:grid-cols-4 gap-8 md:text-center max-w-md md:max-w-none mx-auto">
                <div class="flex gap-4 md:flex-col md:items-center">
                    <div class="h-11 w-11 shrink-0 rounded-full bg-terracotta text-cream font-sans font-bold text-base flex items-center justify-center md:mb-4">1</div>
                    <div>
                        <p class="font-medium text-sm mb-1">Conte sobre seu evento</p>
                        <p class="text-xs text-graphite/60">Informe a data, o tipo e o número aproximado de convidados.</p>
                    </div>
                </div>
                <div class="flex gap-4 md:flex-col md:items-center">
                    <div class="h-11 w-11 shrink-0 rounded-full bg-terracotta text-cream font-sans font-bold text-base flex items-center justify-center md:mb-4">2</div>
                    <div>
                        <p class="font-medium text-sm mb-1">Consulte a disponibilidade</p>
                        <p class="text-xs text-graphite/60">Nossa equipe verifica a data e retorna com as opções.</p>
                    </div>
                </div>
                <div class="flex gap-4 md:flex-col md:items-center">
                    <div class="h-11 w-11 shrink-0 rounded-full bg-terracotta text-cream font-sans font-bold text-base flex items-center justify-center md:mb-4">3</div>
                    <div>
                        <p class="font-medium text-sm mb-1">Conheça o espaço</p>
                        <p class="text-xs text-graphite/60">Agende uma visita e veja de perto a estrutura completa.</p>
                    </div>
                </div>
                <div class="flex gap-4 md:flex-col md:items-center">
                    <div class="h-11 w-11 shrink-0 rounded-full bg-terracotta text-cream font-sans font-bold text-base flex items-center justify-center md:mb-4">4</div>
                    <div>
                        <p class="font-medium text-sm mb-1">Reserve sua data</p>
                        <p class="text-xs text-graphite/60">Alinhe os detalhes finais e garanta a sua celebração.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DEPOIMENTOS --}}
    <section id="depoimentos" class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <h2 class="font-sans font-semibold text-sm tracking-[3px] text-terracotta uppercase mb-8">Depoimentos</h2>

        @php
            $depoimentos = \App\Models\Testimonial::where('publicado', true)->latest()->take(6)->get();
        @endphp

        @if ($depoimentos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                @foreach ($depoimentos as $d)
                    <div class="rounded-lg bg-white shadow-sm border border-graphite/5 p-6">
                        <div class="flex text-terracotta mb-3">
                            @for ($s = 1; $s <= 5; $s++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $s > $d->nota ? 'text-graphite/15' : '' }}" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-graphite/70 mb-4">&ldquo;{{ $d->texto }}&rdquo;</p>
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-terracotta/15 text-terracotta font-display font-bold text-xs flex items-center justify-center">
                                {{ strtoupper(substr($d->autor, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-graphite">{{ $d->autor }}</p>
                                <p class="text-xs text-graphite/50">{{ $d->evento_tipo }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="max-w-xl mx-auto">
            @if (session('depoimento_sucesso'))
                <div class="rounded-lg bg-terracotta/10 border border-terracotta/20 p-6 text-center">
                    <p class="text-sm text-graphite">{{ session('depoimento_sucesso') }}</p>
                </div>
            @else
                <details class="group rounded-lg border border-graphite/10 bg-white" @if($errors->any() && old('_form') === 'depoimento') open @endif>
                    <summary class="cursor-pointer list-none flex items-center justify-between px-6 py-4 text-sm font-medium text-graphite">
                        Já viveu um evento com a gente? Deixe seu depoimento
                        <span class="text-terracotta text-lg leading-none transition group-open:rotate-45">+</span>
                    </summary>
                    <form method="POST" action="{{ url('/depoimentos') }}" class="flex flex-col gap-4 px-6 pb-6" novalidate>
                        @csrf
                        <input type="hidden" name="_form" value="depoimento">

                        <div>
                            <label class="block text-xs text-graphite/50 mb-1.5">Seu nome <span class="text-terracotta">*</span></label>
                            <input type="text" name="autor" required value="{{ old('_form') === 'depoimento' ? old('autor') : '' }}"
                                   class="w-full rounded-md border @error('autor') border-red-400 @else border-graphite/15 @enderror bg-white text-graphite px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                            @error('autor') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-graphite/50 mb-1.5">Tipo de evento <span class="text-terracotta">*</span></label>
                            <select name="evento_tipo" required
                                    class="w-full rounded-md border @error('evento_tipo') border-red-400 @else border-graphite/15 @enderror bg-white text-graphite px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                                <option value="">Selecione uma opção</option>
                                @foreach (\App\Models\EventType::orderBy('nome')->get() as $tipo)
                                    <option value="{{ $tipo->nome }}" @selected(old('evento_tipo') == $tipo->nome)>{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                            @error('evento_tipo') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-graphite/50 mb-1.5">Sua avaliação <span class="text-terracotta">*</span></label>
                            <div class="flex gap-1" id="depoimentoEstrelas" data-inicial="{{ old('nota', 0) }}">
                                @for ($s = 1; $s <= 5; $s++)
                                    <button type="button" data-valor="{{ $s }}" aria-label="{{ $s }} estrela(s)"
                                            class="depoimento-estrela text-graphite/20 hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z"></path>
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="nota" id="depoimentoNota" value="{{ old('nota') }}">
                            @error('nota') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-graphite/50 mb-1.5">Seu depoimento <span class="text-terracotta">*</span></label>
                            <textarea name="texto" rows="3" required placeholder="Como foi a sua experiência com a Juari Eventos?"
                                      class="w-full rounded-md border @error('texto') border-red-400 @else border-graphite/15 @enderror bg-white text-graphite placeholder:text-graphite/30 px-4 py-3 text-sm resize-none focus:outline-none focus:border-terracotta transition">{{ old('_form') === 'depoimento' ? old('texto') : '' }}</textarea>
                            @error('texto') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <p class="text-xs text-graphite/40">Seu depoimento passa por uma revisão rápida antes de aparecer na página.</p>

                        <button type="submit"
                                class="rounded-md bg-terracotta text-cream px-6 py-3 text-sm font-medium hover:bg-terracotta-dark transition">
                            Enviar depoimento
                        </button>
                    </form>
                </details>

                <script>
                    (function () {
                        const wrap = document.getElementById('depoimentoEstrelas');
                        if (!wrap) return;
                        const botoes = Array.from(wrap.querySelectorAll('.depoimento-estrela'));
                        const input = document.getElementById('depoimentoNota');
                        const inicial = Number(wrap.dataset.inicial) || 0;

                        function pintar(valor) {
                            botoes.forEach(botao => {
                                const ativo = Number(botao.dataset.valor) <= valor;
                                botao.classList.toggle('text-terracotta', ativo);
                                botao.classList.toggle('text-graphite/20', !ativo);
                            });
                        }

                        botoes.forEach(botao => {
                            botao.addEventListener('click', () => {
                                const valor = Number(botao.dataset.valor);
                                input.value = valor;
                                pintar(valor);
                            });
                        });

                        if (inicial > 0) pintar(inicial);
                    })();
                </script>
            @endif
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="max-w-6xl mx-auto px-6 py-16 grid gap-10 md:grid-cols-[1fr_2fr] border-t border-graphite/10">
        <div>
            <p class="font-sans font-semibold text-sm tracking-[3px] text-terracotta uppercase mb-3">Dúvidas frequentes</p>
            <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-4">Tudo o que você precisa saber</h2>
            <p class="text-graphite/60 text-sm mb-6">Se ainda houver alguma dúvida, fale com nossa equipe.</p>
            <a href="https://wa.me/5543996497714" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 text-terracotta text-sm font-medium hover:text-terracotta-dark transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 0 0-8.6 15l-1.2 4.4 4.5-1.2A10 10 0 1 0 12 2Zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.7.7.7-2.6-.2-.3A8 8 0 1 1 12 20Zm4.4-5.5c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.5.1-.2.2-.6.8-.7.9-.1.2-.3.2-.5.1-.2-.1-1-.4-2-1.2-.7-.6-1.2-1.4-1.4-1.6-.1-.2 0-.4.1-.5l.4-.4c.1-.1.2-.2.2-.4.1-.1 0-.3 0-.4-.1-.1-.5-1.2-.7-1.7-.2-.4-.4-.4-.5-.4h-.5c-.1 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2 1 2.4c.1.1 1.6 2.5 3.9 3.5.5.2.9.4 1.3.5.5.2 1 .1 1.3-.1.4-.2 1.4-.6 1.6-1.1.2-.6.2-1 .1-1.1-.1-.1-.2-.2-.4-.2Z"></path>
                </svg>
                Conversar pelo WhatsApp
            </a>
        </div>

        <div class="divide-y divide-graphite/10">
            @php
                $faqs = [
                    'Qual a capacidade do espaço?' => 'O espaço comporta até 200 convidados. A quantidade ideal pode variar conforme a montagem e o tipo de evento.',
                    'É possível levar buffet próprio?' => 'Sim, o espaço permite a contratação de fornecedores externos de buffet.',
                    'Como funciona a reserva de data?' => 'A reserva é feita mediante contato pelo WhatsApp e confirmação da disponibilidade da data.',
                    'O espaço possui área kids?' => 'Sim, contamos com um espaço kids dedicado para festas infantis.',
                    'Existe horário limite para o evento?' => 'O horário é combinado previamente conforme o tipo e a duração do evento contratado.',
                    'Como é feito o pagamento do orçamento?' => 'As condições de pagamento são definidas diretamente com nossa equipe no momento do orçamento.',
                ];
            @endphp
            @foreach ($faqs as $pergunta => $resposta)
                <details class="group py-4" @if($loop->first) open @endif>
                    <summary class="cursor-pointer list-none flex items-center justify-between text-sm md:text-base font-medium text-graphite">
                        {{ $pergunta }}
                        <span class="text-terracotta text-lg leading-none transition group-open:rotate-45">+</span>
                    </summary>
                    <p class="text-sm text-graphite/60 mt-3 pr-8">{{ $resposta }}</p>
                </details>
            @endforeach
        </div>
    </section>

    {{-- FORMULÁRIO DE ORÇAMENTO --}}
    <section id="orcamento" class="grid grid-cols-1 md:grid-cols-2 border-t border-graphite/10">
        <div class="hidden md:block bg-cover bg-center min-h-[420px]"
             style="background-image: url('{{ $capaHome ?? asset('images/fachada.jpg') }}');"></div>

        <div class="bg-graphite px-6 py-16 md:px-12 flex items-center">
            <div class="max-w-md w-full mx-auto">

                @if (session('sucesso'))
                    {{-- TELA DE CONFIRMAÇÃO --}}
                    <div class="text-center">
                        <div class="h-14 w-14 rounded-full bg-terracotta/20 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </div>
                        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-cream mb-3">
                            Solicitação enviada!
                        </h2>
                        <p class="text-cream/70 text-sm mb-8">
                            {{ session('sucesso') }}
                        </p>

                        @if (session('resumo'))
                            <div class="rounded-md bg-graphite-light border border-cream/10 px-5 py-4 text-left text-sm text-cream/80 mb-8 space-y-1">
                                <p><span class="text-cream/50">Nome:</span> {{ session('resumo')['nome'] }}</p>
                                <p><span class="text-cream/50">Evento:</span> {{ session('resumo')['evento'] }}</p>
                                @if (session('resumo')['data'])
                                    <p><span class="text-cream/50">Data:</span> {{ \Carbon\Carbon::parse(session('resumo')['data'])->format('d/m/Y') }}</p>
                                @endif
                            </div>
                        @endif

                        <p class="text-cream/60 text-xs mb-4">
                            Enquanto isso, adiante o seu atendimento falando direto com a nossa equipe:
                        </p>
                        <a href="https://wa.me/5543996497714" target="_blank" rel="noopener"
                           class="inline-flex items-center justify-center gap-2 rounded-md bg-green-600 text-white px-6 py-3 text-sm font-medium hover:bg-green-700 transition w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 32 32" fill="currentColor">
                                <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.362.688 4.564 1.874 6.417L4 29l7.783-1.845A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3Zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.62 1.095 1.127-4.505-.233-.37A9.78 9.78 0 0 1 5.182 15c0-5.964 4.854-10.818 10.819-10.818 5.963 0 10.817 4.854 10.817 10.818 0 5.964-4.854 10.818-10.817 10.818Zm5.928-8.106c-.325-.163-1.923-.949-2.222-1.058-.298-.109-.515-.163-.732.163-.217.326-.84 1.058-1.03 1.276-.19.217-.379.244-.704.081-.325-.163-1.372-.505-2.613-1.611-.966-.861-1.618-1.924-1.808-2.249-.19-.326-.02-.502.143-.664.147-.146.325-.38.488-.57.163-.19.217-.326.326-.543.109-.217.054-.407-.027-.57-.081-.163-.732-1.765-1.003-2.417-.264-.634-.532-.548-.732-.558-.19-.009-.407-.011-.624-.011-.217 0-.57.081-.868.407-.298.325-1.138 1.112-1.138 2.714 0 1.602 1.165 3.15 1.327 3.367.163.217 2.293 3.503 5.557 4.912.777.335 1.383.535 1.856.685.78.248 1.489.213 2.05.129.625-.093 1.923-.786 2.194-1.545.271-.759.271-1.41.19-1.545-.081-.135-.298-.217-.624-.38Z"></path>
                            </svg>
                            Conversar no WhatsApp agora
                        </a>
                    </div>
                @else
                    {{-- FORMULÁRIO --}}
                    <h2 class="font-display font-extrabold text-2xl md:text-3xl text-cream mb-3">
                        Vamos planejar o seu evento juntos?
                    </h2>
                    <div class="w-14 h-0.5 bg-terracotta mb-4"></div>
                    <p class="text-cream/70 text-sm mb-8">
                        Preencha o formulário abaixo para receber nosso contato.
                    </p>

                    <form method="POST" action="{{ url('/orcamento') }}" class="flex flex-col gap-4">
                        @csrf

                        <div>
                            <label class="block text-xs text-cream/50 mb-1.5">Nome completo <span class="text-terracotta">*</span></label>
                            <input type="text" name="nome" required value="{{ old('nome') }}"
                                   class="w-full rounded-md border @error('nome') border-red-400 @else border-cream/20 @enderror bg-graphite-light text-cream px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                            @error('nome') <p class="text-red-300 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-cream/50 mb-1.5">WhatsApp <span class="text-terracotta">*</span></label>
                            <input type="text" name="telefone" required value="{{ old('telefone') }}" placeholder="(43) 90000-0000"
                                   class="w-full rounded-md border @error('telefone') border-red-400 @else border-cream/20 @enderror bg-graphite-light text-cream placeholder:text-cream/30 px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                            @error('telefone') <p class="text-red-300 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-cream/50 mb-1.5">Data do evento <span class="text-terracotta">*</span></label>
                                <div class="relative">
                                    <input type="text" id="data_evento" name="data_evento" required readonly
                                           value="{{ old('data_evento') }}" placeholder="Selecione a data"
                                           class="w-full rounded-md border @error('data_evento') border-red-400 @else border-cream/20 @enderror bg-graphite-light text-cream placeholder:text-cream/30 px-4 py-3 pr-10 text-sm focus:outline-none focus:border-terracotta transition cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute right-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                        <path d="M16 3v4M8 3v4M3 10h18"></path>
                                    </svg>
                                </div>
                                @error('data_evento') <p class="text-red-300 text-xs mt-1.5">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs text-cream/50 mb-1.5">Convidados <span class="text-terracotta">*</span></label>
                                <input type="number" name="numero_convidados" required min="40" max="200" placeholder="Ex: 80" value="{{ old('numero_convidados') }}"
                                       class="w-full rounded-md border @error('numero_convidados') border-red-400 @else border-cream/20 @enderror bg-graphite-light text-cream placeholder:text-cream/30 px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                                @error('numero_convidados') <p class="text-red-300 text-xs mt-1.5">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-cream/50 mb-1.5">Tipo de evento <span class="text-terracotta">*</span></label>
                            <select name="event_type_id" required
                                    class="w-full rounded-md border @error('event_type_id') border-red-400 @else border-cream/20 @enderror bg-graphite-light text-cream px-4 py-3 text-sm focus:outline-none focus:border-terracotta transition">
                                <option value="">Selecione uma opção</option>
                                @foreach (\App\Models\EventType::orderBy('nome')->get() as $tipo)
                                    <option value="{{ $tipo->id }}" @selected(old('event_type_id') == $tipo->id)>{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                            @error('event_type_id') <p class="text-red-300 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-cream/50 mb-1.5">Detalhes adicionais</label>
                            <textarea name="mensagem" rows="3" placeholder="Não obrigatório"
                                      class="w-full rounded-md border border-cream/20 bg-graphite-light text-cream placeholder:text-cream/30 px-4 py-3 text-sm resize-none focus:outline-none focus:border-terracotta transition">{{ old('mensagem') }}</textarea>
                        </div>

                        <button type="submit"
                                class="rounded-md bg-terracotta text-cream px-6 py-3 text-sm font-medium hover:bg-terracotta-dark transition mt-2">
                            Enviar solicitação
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('sucesso') || (old('_form') !== 'depoimento' && $errors->any()))
                document.getElementById('orcamento').scrollIntoView({ behavior: 'instant', block: 'start' });
            @elseif (session('depoimento_sucesso') || (old('_form') === 'depoimento' && $errors->any()))
                document.getElementById('depoimentos').scrollIntoView({ behavior: 'instant', block: 'start' });
            @endif

            if (window.flatpickr) {
                flatpickr("#data_evento", {
                    locale: "pt",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d/m/Y",
                    minDate: new Date().fp_incr(3),
                    maxDate: new Date().fp_incr(5 * 365),
                    disableMobile: true,
                });
            }
        });
    </script>

@endsection
