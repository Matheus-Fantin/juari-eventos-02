<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display font-extrabold text-2xl text-graphite">Olá, {{ auth()->user()->name }}</h1>
        <p class="text-sm text-graphite/60 mt-1">Painel da Juari Eventos.</p>
    </x-slot>

    @if (auth()->user()->papel === 'admin')
        <div class="grid gap-6 sm:grid-cols-2">
            <a href="{{ route('admin.testimonials.index') }}"
               class="rounded-xl border border-graphite/10 bg-white p-6 hover:border-terracotta hover:shadow-sm transition">
                <p class="font-display font-semibold text-xs tracking-[2px] text-terracotta uppercase mb-2">Depoimentos</p>
                <h2 class="font-display font-bold text-lg text-graphite mb-1">Aprovar ou remover depoimentos</h2>
                <p class="text-sm text-graphite/60">
                    {{ \App\Models\Testimonial::where('publicado', false)->count() }} pendente(s) de revisão.
                </p>
            </a>

            <a href="{{ route('admin.galleries.index') }}"
               class="rounded-xl border border-graphite/10 bg-white p-6 hover:border-terracotta hover:shadow-sm transition">
                <p class="font-display font-semibold text-xs tracking-[2px] text-terracotta uppercase mb-2">Galeria</p>
                <h2 class="font-display font-bold text-lg text-graphite mb-1">Adicionar ou excluir fotos</h2>
                <p class="text-sm text-graphite/60">
                    {{ \App\Models\Photo::count() }} foto(s) publicadas no site.
                </p>
            </a>
        </div>
    @else
        <div class="rounded-xl border border-graphite/10 bg-white p-6">
            <p class="text-sm text-graphite/70">
                Sua conta ainda não tem acesso ao painel administrativo. Fale com a administradora do site
                se precisar gerenciar depoimentos ou fotos.
            </p>
        </div>
    @endif
</x-app-layout>
