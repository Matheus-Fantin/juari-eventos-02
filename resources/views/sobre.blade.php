@extends('layouts.app')

@section('title', 'Sobre — Juari Eventos')

@section('content')

    @php
        $capaSobre = 'images/sobre/capa.jpg';
        $existeCapaSobre = file_exists(public_path($capaSobre));
    @endphp

    {{-- HERO --}}
    <section class="relative h-[50vh] min-h-[360px] bg-cover bg-center flex items-end {{ $existeCapaSobre ? '' : 'bg-graphite-light animate-pulse' }}"
             @if($existeCapaSobre) style="background-image: url('{{ asset($capaSobre) }}');" @endif>
        <div class="absolute inset-0 bg-gradient-to-t from-graphite/85 via-graphite/25 to-transparent"></div>
        @unless($existeCapaSobre)
            <div class="absolute inset-0 flex items-center justify-center text-graphite/40 text-xs">
                {{ $capaSobre }}
            </div>
        @endunless
        <div class="relative max-w-6xl mx-auto px-6 pb-12 text-center w-full">
            <p class="font-display font-semibold text-sm tracking-[3px] text-terracotta mb-3">JUARI EVENTOS</p>
            <h1 class="font-display font-extrabold text-3xl md:text-4xl text-cream">Sobre o espaço</h1>
            <p class="text-cream/80 mt-3">Conheça a Juari Eventos, em Sertanópolis — PR.</p>
        </div>
    </section>

    {{-- BLOCO 1 --}}
    @php $img1 = 'images/sobre/sobre-1.jpg'; $existe1 = file_exists(public_path($img1)); @endphp
    <section class="max-w-6xl mx-auto px-6 py-16 grid gap-10 md:grid-cols-2 items-center">
        <div>
            <h2 class="font-display font-semibold text-base tracking-[2px] text-terracotta uppercase mb-4">Um espaço para cada momento</h2>
            <p class="text-graphite/80 text-base leading-relaxed">
                A Juari Eventos nasceu para transformar momentos em memórias inesquecíveis. Nosso espaço foi
                pensado para receber celebrações de todos os tipos — de casamentos elegantes a festas infantis
                cheias de energia, passando por aniversários, formaturas, chás de bebê e confraternizações
                corporativas. Cada detalhe da estrutura é pensado para se adaptar ao seu evento, não o contrário.
            </p>
        </div>
        <div class="rounded-xl overflow-hidden aspect-video {{ $existe1 ? 'bg-cover bg-center' : 'bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40' }}"
             @if($existe1) style="background-image: url('{{ asset($img1) }}');" @endif>
            @unless($existe1) {{ $img1 }} @endunless
        </div>
    </section>

    {{-- BLOCO 2 (imagem invertida para a esquerda) --}}
    @php $img2 = 'images/sobre/sobre-2.jpg'; $existe2 = file_exists(public_path($img2)); @endphp
    <section class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10 grid gap-10 md:grid-cols-2 items-center">
        <div class="rounded-xl overflow-hidden aspect-video md:order-1 {{ $existe2 ? 'bg-cover bg-center' : 'bg-graphite-light/10 animate-pulse flex items-center justify-center text-xs text-graphite/40' }}"
             @if($existe2) style="background-image: url('{{ asset($img2) }}');" @endif>
            @unless($existe2) {{ $img2 }} @endunless
        </div>
        <div class="md:order-2">
            <h2 class="font-display font-semibold text-base tracking-[2px] text-terracotta uppercase mb-4">Compromisso com cada detalhe</h2>
            <p class="text-graphite/80 text-base leading-relaxed">
                Nossa equipe acompanha cada etapa da organização para que você não precise se preocupar com nada
                além de aproveitar o seu dia. Do primeiro contato à realização do evento, cuidamos da estrutura,
                do espaço e do suporte necessário para que a celebração saia exatamente como você imaginou.
            </p>
        </div>
    </section>

    {{-- ESTRUTURA DO ESPAÇO (grid com ícones) --}}
    <section class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <p class="font-display font-semibold text-xs tracking-[3px] text-terracotta uppercase mb-2">Estrutura do Espaço</p>
        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-8">
            Tudo pronto para o seu evento, do início ao fim
        </h2>

        @php
            $estrutura = [
                ['nome' => 'Salão Amplo', 'icone' => 'M4 21h16M4 21V9l8-6 8 6v12M9 21v-6h6v6'],
                ['nome' => 'Área Coberta', 'icone' => 'M3 12l9-8 9 8M5 10v10h14V10'],
                ['nome' => 'Espaço Kids', 'icone' => 'M12 8a3 3 0 100-6 3 3 0 000 6zM6 21v-4a4 4 0 014-4h4a4 4 0 014 4v4'],
                ['nome' => 'Ar-condicionado', 'icone' => 'M3 12h18M12 3v18M6 6l12 12M18 6L6 18'],
                ['nome' => 'Fogão a Lenha', 'icone' => 'M12 2c2 3-2 4-2 7a2 2 0 104 0c0-1-.5-1.5-1-2'],
                ['nome' => 'Churrasqueira', 'icone' => 'M4 12h16M6 12v6a2 2 0 002 2h8a2 2 0 002-2v-6'],
                ['nome' => 'Cozinha de Apoio', 'icone' => 'M7 3v6M11 3v6M7 6h4M15 3l-3 9h6l-3 9'],
                ['nome' => 'Banheiros', 'icone' => 'M9 3v18M15 3a3 3 0 013 3v15M15 9h3'],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 border border-graphite/10 rounded-lg overflow-hidden divide-x divide-y divide-graphite/10 md:divide-y-0">
            @foreach ($estrutura as $item)
                <div class="flex flex-col items-center justify-center text-center gap-2.5 px-4 py-8 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-terracotta" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="{{ $item['icone'] }}"></path>
                    </svg>
                    <span class="text-sm text-graphite/80">{{ $item['nome'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- DETALHES QUE FAZEM A DIFERENÇA --}}
    <section class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <p class="font-display font-semibold text-xs tracking-[3px] text-terracotta uppercase mb-2">Como funciona</p>
        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-8">
            Detalhes que fazem a diferença
        </h2>

        @php
            $diferenciais = [
                ['titulo' => 'Sem cobrança de aluguel', 'texto' => 'O valor do pacote já cobre o uso do espaço — sem taxa extra por locação.', 'icone' => 'M9 12l2 2 4-4M12 3l9 4.5v9L12 21l-9-4.5v-9L12 3Z'],
                ['titulo' => 'Buffet completo incluso', 'texto' => 'Do coquetel de boas-vindas ao serviço de madrugada, com garçons e todo o material de mesa.', 'icone' => 'M4 12h16M6 12v6a2 2 0 002 2h8a2 2 0 002-2v-6M9 8V4h6v4'],
                ['titulo' => 'Duração combinada com você', 'texto' => 'Festas infantis giram em torno de 3 a 4 horas; jantares e coquetéis de adultos, cerca de 7 horas.', 'icone' => 'M12 8v4l3 3M12 21a9 9 0 100-18 9 9 0 000 18Z'],
                ['titulo' => 'Segurança sob demanda', 'texto' => 'Monitor e bombeiro civil disponíveis mediante contratação, para eventos que exigem mais estrutura.', 'icone' => 'M12 3l8 3v6c0 4.5-3.4 8.2-8 9-4.6-.8-8-4.5-8-9V6l8-3Z'],
                ['titulo' => 'Parcelamento facilitado', 'texto' => 'Reserva com entrada mínima e o restante parcelado em até 3x sem juros.', 'icone' => 'M3 7h18M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l2-4h14l2 4M8 15h2'],
                ['titulo' => 'Cardápio personalizável', 'texto' => 'Cada menu pode ser ajustado com a nossa equipe conforme o estilo do seu evento.', 'icone' => 'M4 19h16M6 19V9a6 6 0 0112 0v10'],
            ];
        @endphp

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($diferenciais as $item)
                <div class="rounded-xl border border-graphite/10 bg-white p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-terracotta mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="{{ $item['icone'] }}"></path>
                    </svg>
                    <p class="font-display font-semibold text-sm text-graphite mb-1.5">{{ $item['titulo'] }}</p>
                    <p class="text-sm text-graphite/60 leading-relaxed">{{ $item['texto'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- GASTRONOMIA --}}
    <section id="gastronomia" class="max-w-6xl mx-auto px-6 py-16 border-t border-graphite/10">
        <p class="font-display font-semibold text-xs tracking-[3px] text-terracotta uppercase mb-2">Gastronomia</p>
        <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-4">
            Cardápios pensados para cada tipo de celebração
        </h2>
        <p class="text-graphite/70 text-base leading-relaxed mb-10 max-w-2xl">
            Trabalhamos com buffet completo, do coquetel de boas-vindas ao serviço de madrugada,
            com opções específicas para festas infantis e para jantares e coquetéis de eventos adultos.
            Todos os cardápios são personalizáveis — fale com a nossa equipe para montar o menu ideal para o seu evento.
        </p>

        <div class="grid gap-6 md:grid-cols-2">

            {{-- Card: Festas Kids --}}
            <div class="rounded-xl border border-graphite/10 bg-white p-6">
                <h3 class="font-display font-semibold text-lg text-graphite mb-1">Festas Infantis</h3>
                <p class="text-xs text-graphite/50 mb-5">Cardápio kids, com opção de decoração temática</p>

                <div class="space-y-4 text-sm text-graphite/75">
                    <div>
                        <p class="font-medium text-graphite mb-1">Entrada</p>
                        <p>Lanchinho natural ou hot dog tradicional, canudinho com maionese</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Salgados</p>
                        <p>Até 8 opções entre fritos e assados — coxinha, pastel, esfirra, croquete, risoles e mais</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Doces & Bolo</p>
                        <p>Brigadeiros, beijinho e bicho de pé, com bolo à escolha entre 11 sabores</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Estrutura inclusa</p>
                        <p>Brinquedos (cama elástica, tombo legal, aero hokey), recreação monitorada, decoração temática e convite virtual</p>
                    </div>
                </div>
            </div>

            {{-- Card: Jantares e Coquetéis --}}
            <div class="rounded-xl border border-graphite/10 bg-white p-6">
                <h3 class="font-display font-semibold text-lg text-graphite mb-1">Jantares & Coquetéis</h3>
                <p class="text-xs text-graphite/50 mb-5">Casamentos, formaturas, corporativo e mais</p>

                <div class="space-y-4 text-sm text-graphite/75">
                    <div>
                        <p class="font-medium text-graphite mb-1">Coquetel de boas-vindas</p>
                        <p>Finger foods e mesa de antepastos com queijos, frios e conservas</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Jantar</p>
                        <p>Arroz, risoto ou farofa, carnes (boi, frango ou suína) e massas artesanais</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Saladas</p>
                        <p>Opções frescas e clássicas, sempre à sua escolha</p>
                    </div>
                    <div>
                        <p class="font-medium text-graphite mb-1">Madrugada</p>
                        <p>Lanche leve para fechar a noite com os convidados</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}#orcamento"
               class="inline-block rounded-md bg-terracotta text-cream px-6 py-3 text-sm font-medium hover:bg-terracotta-dark transition">
                Consultar cardápio completo
            </a>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="bg-cream border-t border-graphite/10">
        <div class="max-w-6xl mx-auto px-6 py-16 text-center">
            <h2 class="font-display font-extrabold text-2xl md:text-3xl text-graphite mb-4">
                Vamos planejar o seu evento?
            </h2>
            <p class="text-graphite/70 text-base mb-8">Fale com a nossa equipe e garanta a sua data.</p>
            <a href="{{ url('/') }}#orcamento"
               class="inline-block rounded-md bg-terracotta text-cream px-6 py-3 text-sm font-medium hover:bg-terracotta-dark transition">
                Solicitar orçamento
            </a>
        </div>
    </section>

@endsection