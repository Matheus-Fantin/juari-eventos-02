<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Juari Eventos')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/pt.js"></script>

        <style>
        .flatpickr-calendar {
            background: #2c2c2a;
            border: 1px solid rgba(241, 239, 232, 0.15);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }
        .flatpickr-calendar.arrowTop:before,
        .flatpickr-calendar.arrowTop:after {
            border-bottom-color: #2c2c2a;
        }

        /* Cabeçalho: mês, ano e setas de navegação */
        .flatpickr-months {
            background: #2c2c2a;
            padding: 6px 0;
        }
        .flatpickr-current-month {
            color: #f1efe8;
        }
        .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: transparent;
            color: #f1efe8;
            font-weight: 600;
        }
        .flatpickr-current-month .flatpickr-monthDropdown-months option {
            background: #070707;
            color: #414040;
        }
        .flatpickr-current-month input.cur-year {
            background: transparent;
            color: #f1efe8;
            font-weight: 600;
        }
        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: #f1efe8;
            fill: #f1efe8;
        }
        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            fill: #f1efe8;
            width: 14px;
            height: 14px;
        }
        .flatpickr-prev-month:hover svg,
        .flatpickr-next-month:hover svg {
            fill: #a85c3b;
        }

        /* Dias da semana (D S T Q Q S S) */
        .flatpickr-weekdays { background: #2c2c2a; }
        span.flatpickr-weekday {
            color: #d3d1c7;
            background: #2c2c2a;
            font-weight: 600;
        }

        /* Dias do mês */
        .flatpickr-day {
            color: #f1efe8;
        }
        .flatpickr-day.prevMonthDay,
        .flatpickr-day.nextMonthDay {
            color: rgba(241, 239, 232, 0.35);
        }
        .flatpickr-day.flatpickr-disabled,
        .flatpickr-day.flatpickr-disabled:hover {
            color: rgba(241, 239, 232, 0.2);
            cursor: not-allowed;
        }
        .flatpickr-day:hover {
            background: rgba(168, 92, 59, 0.25);
            border-color: transparent;
        }
        .flatpickr-day.selected,
        .flatpickr-day.selected:hover {
            background: #a85c3b;
            border-color: #a85c3b;
            color: #f1efe8;
        }
        .flatpickr-day.today {
            border-color: #a85c3b;
        }
        .flatpickr-day.today:hover {
            background: #a85c3b;
            color: #f1efe8;
        }
    </style>

    <style>
        .font-logo { font-family: 'Cormorant Garamond', serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-graphite bg-cream antialiased notranslate">

    <header class="absolute top-0 inset-x-0 z-30 bg-gradient-to-b from-graphite/60 to-transparent">
        <nav class="max-w-6xl mx-auto flex items-center justify-between px-6 py-5">
            <a href="{{ url('/') }}" class="leading-none relative z-40 font-logo">
                <span class="font-semibold text-3xl tracking-[2px] text-cream">JUARI</span>
                <span class="italic font-medium text-sm text-cream/75 block -mt-1">Eventos</span>
            </a>

            <ul class="hidden md:flex items-center gap-8 text-sm text-cream/80">
                <li>
                    <a href="{{ url('/') }}" class="flex items-center gap-1.5 hover:text-cream transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 11l9-8 9 8"></path>
                            <path d="M5 10v10h14V10"></path>
                        </svg>
                        Início
                    </a>
                </li>
                <li><a href="{{ url('/sobre') }}" class="hover:text-cream transition">Sobre</a></li>
                <li><a href="{{ url('/') }}#eventos" class="hover:text-cream transition">Eventos</a></li>
                <li><a href="{{ url('/galeria') }}" class="hover:text-cream transition">Galeria</a></li>
                <li><a href="{{ url('/') }}#faq" class="hover:text-cream transition">FAQ</a></li>
                <li><a href="{{ url('/') }}#contato" class="hover:text-cream transition">Contato</a></li>
            </ul>

            <a href="{{ url('/') }}#orcamento"
               class="hidden md:inline-flex items-center rounded-md bg-terracotta px-4 py-2 text-sm font-medium text-cream hover:bg-terracotta-dark transition">
                Orçamento
            </a>

            <button id="menu-toggle" type="button"
                    class="md:hidden relative z-40 h-9 w-9 flex items-center justify-center text-cream"
                    aria-label="Abrir menu">
                <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 6l12 12M18 6L6 18"></path>
                </svg>
            </button>
        </nav>

        <div id="menu-mobile" class="hidden md:hidden bg-graphite px-6 pb-6">
            <ul class="flex flex-col gap-4 text-sm text-cream/90 pt-2">
                <li><a href="{{ url('/') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 11l9-8 9 8"></path><path d="M5 10v10h14V10"></path>
                        </svg>
                        Início
                </a></li>
                <li><a href="{{ url('/sobre') }}">Sobre</a></li>
                <li><a href="{{ url('/') }}#eventos">Eventos</a></li>
                <li><a href="{{ url('/galeria') }}">Galeria</a></li>
                <li><a href="{{ url('/') }}#faq">FAQ</a></li>
                <li><a href="{{ url('/') }}#contato">Contato</a></li>
                <li>
                    <a href="{{ url('/') }}#orcamento"
                       class="inline-block rounded-md bg-terracotta px-4 py-2 text-cream font-medium">
                        Solicitar orçamento
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer id="contato" class="bg-cream border-t border-graphite/10">
        <div class="max-w-6xl mx-auto px-6 py-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-4 text-sm text-graphite/70">

            {{-- Coluna 1: Logo + descrição --}}
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="leading-none block font-logo">
                    <span class="font-semibold text-2xl tracking-[2px] text-graphite">JUARI</span>
                    <span class="italic font-medium text-xs text-graphite/70 block -mt-1">Eventos</span>
                </a>
                <p class="text-graphite/60 leading-relaxed">
                    Espaço para casamentos, festas e eventos corporativos em Sertanópolis-PR.
                    Estrutura completa, do salão ao espaço kids.
                </p>
                <div class="flex items-center gap-3 pt-1">
                    <a href="https://www.instagram.com/juarieventos" target="_blank" rel="noopener"
                       class="h-9 w-9 flex items-center justify-center rounded-full border border-graphite/15 text-graphite/60 hover:text-terracotta hover:border-terracotta transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="3" width="18" height="18" rx="5"></rect>
                            <circle cx="12" cy="12" r="4"></circle>
                            <circle cx="17.5" cy="6.5" r="1"></circle>
                        </svg>
                    </a>
                    <a href="https://wa.me/5543996497714" target="_blank" rel="noopener"
                       class="h-9 w-9 flex items-center justify-center rounded-full border border-graphite/15 text-graphite/60 hover:text-terracotta hover:border-terracotta transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a10 10 0 0 0-8.6 15l-1.2 4.4 4.5-1.2A10 10 0 1 0 12 2Zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.7.7.7-2.6-.2-.3A8 8 0 1 1 12 20Zm4.4-5.5c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.5.1-.2.2-.6.8-.7.9-.1.2-.3.2-.5.1-.2-.1-1-.4-2-1.2-.7-.6-1.2-1.4-1.4-1.6-.1-.2 0-.4.1-.5l.4-.4c.1-.1.2-.2.2-.4.1-.1 0-.3 0-.4-.1-.1-.5-1.2-.7-1.7-.2-.4-.4-.4-.5-.4h-.5c-.1 0-.4.1-.6.3-.2.2-.8.8-.8 1.9s.8 2.2 1 2.4c.1.1 1.6 2.5 3.9 3.5.5.2.9.4 1.3.5.5.2 1 .1 1.3-.1.4-.2 1.4-.6 1.6-1.1.2-.6.2-1 .1-1.1-.1-.1-.2-.2-.4-.2Z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Coluna 2: Contato --}}
            <div>
                <p class="font-display font-semibold text-xs tracking-[2px] text-graphite/50 uppercase mb-4">Contato</p>
                <ul class="space-y-2.5">
                    <li><a href="https://wa.me/5543996497714" target="_blank" rel="noopener" class="hover:text-terracotta transition">(43) 99649-7714</a></li>
                    <li><a href="mailto:contato@juarieventos.com.br" class="hover:text-terracotta transition">contato@juarieventos.com.br</a></li>
                    <li><a href="https://www.instagram.com/juarieventos" target="_blank" rel="noopener" class="hover:text-terracotta transition">@juarieventos</a></li>
                </ul>
            </div>

            {{-- Coluna 3: Navegação --}}
            <div>
                <p class="font-display font-semibold text-xs tracking-[2px] text-graphite/50 uppercase mb-4">Navegação</p>
                <ul class="space-y-2.5">
                    <li><a href="{{ url('/') }}#eventos" class="hover:text-terracotta transition">Tipos de Evento</a></li>
                    <li><a href="{{ url('/galeria') }}" class="hover:text-terracotta transition">Galeria</a></li>
                    <li><a href="{{ url('/sobre') }}" class="hover:text-terracotta transition">Sobre</a></li>
                    <li><a href="{{ url('/') }}#contato" class="hover:text-terracotta transition">Contato</a></li>
                </ul>
            </div>

            {{-- Coluna 4: Localização + mapa --}}
            <div>
                <p class="font-display font-semibold text-xs tracking-[2px] text-graphite/50 uppercase mb-4">Localização</p>
                <p class="mb-4 leading-relaxed">
                    Rua Antônio da Aparecida Parisoto Loureiro, 200 — Pq. Industrial, Sertanópolis-PR
                </p>
                <div class="rounded-md overflow-hidden border border-terracotta/30">
                    <div class="h-28">
                        <iframe
                            src="https://www.google.com/maps?q=Rua+Antonio+da+Aparecida+Parisoto+Loureiro,+200,+Sertan%C3%B3polis+-+PR&output=embed"
                            width="100%" height="100%" style="border:0" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <a href="https://www.google.com/maps?q=Rua+Antonio+da+Aparecida+Parisoto+Loureiro,+200,+Sertan%C3%B3polis+-+PR"
                       target="_blank" rel="noopener"
                       class="flex items-center justify-between px-3 py-2.5 text-xs font-medium text-terracotta hover:bg-terracotta/5 transition">
                        Como chegar
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M13 6l6 6-6 6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-graphite/10">
            <div class="max-w-6xl mx-auto px-6 py-5 text-xs text-graphite/50">
                &copy; {{ date('Y') }} Juari Eventos. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/5543996497714" target="_blank" rel="noopener"
       class="fixed bottom-6 right-6 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-green-600 text-white shadow-lg hover:bg-green-700 hover:scale-105 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 32 32" fill="currentColor">
            <path d="M16.001 3C9.373 3 4 8.373 4 15c0 2.362.688 4.564 1.874 6.417L4 29l7.783-1.845A11.94 11.94 0 0 0 16.001 27C22.628 27 28 21.627 28 15S22.628 3 16.001 3Zm0 21.818a9.77 9.77 0 0 1-4.98-1.363l-.357-.212-4.62 1.095 1.127-4.505-.233-.37A9.78 9.78 0 0 1 5.182 15c0-5.964 4.854-10.818 10.819-10.818 5.963 0 10.817 4.854 10.817 10.818 0 5.964-4.854 10.818-10.817 10.818Zm5.928-8.106c-.325-.163-1.923-.949-2.222-1.058-.298-.109-.515-.163-.732.163-.217.326-.84 1.058-1.03 1.276-.19.217-.379.244-.704.081-.325-.163-1.372-.505-2.613-1.611-.966-.861-1.618-1.924-1.808-2.249-.19-.326-.02-.502.143-.664.147-.146.325-.38.488-.57.163-.19.217-.326.326-.543.109-.217.054-.407-.027-.57-.081-.163-.732-1.765-1.003-2.417-.264-.634-.532-.548-.732-.558-.19-.009-.407-.011-.624-.011-.217 0-.57.081-.868.407-.298.325-1.138 1.112-1.138 2.714 0 1.602 1.165 3.15 1.327 3.367.163.217 2.293 3.503 5.557 4.912.777.335 1.383.535 1.856.685.78.248 1.489.213 2.05.129.625-.093 1.923-.786 2.194-1.545.271-.759.271-1.41.19-1.545-.081-.135-.298-.217-.624-.38Z"></path>
        </svg>
    </a>

    <button id="back-to-top" type="button" aria-label="Voltar ao topo"
            class="hidden fixed bottom-24 right-6 z-40 h-11 w-11 items-center justify-center rounded-full bg-graphite text-cream shadow-lg hover:bg-graphite-light transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 19V5M5 12l7-7 7 7"></path>
        </svg>
    </button>

    <script>
        var menuToggle = document.getElementById('menu-toggle');
        var menuMobile = document.getElementById('menu-mobile');
        var iconMenu = document.getElementById('icon-menu');
        var iconClose = document.getElementById('icon-close');

        if (menuToggle && menuMobile) {
            menuToggle.addEventListener('click', function () {
                menuMobile.classList.toggle('hidden');
                iconMenu.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }

        var backToTop = document.getElementById('back-to-top');
        if (backToTop) {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 500) {
                    backToTop.classList.remove('hidden');
                    backToTop.classList.add('flex');
                } else {
                    backToTop.classList.add('hidden');
                    backToTop.classList.remove('flex');
                }
            });
            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>

</body>
</html>