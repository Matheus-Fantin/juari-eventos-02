<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $depoimentos = Testimonial::orderBy('publicado')->latest()->get();

        return view('admin.testimonials.index', ['depoimentos' => $depoimentos]);
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['publicado' => true]);

        return back()->with('status', 'Depoimento de ' . $testimonial->autor . ' publicado no site.');
    }

    public function unpublish(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['publicado' => false]);

        return back()->with('status', 'Depoimento de ' . $testimonial->autor . ' removido do site (continua salvo aqui).');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return back()->with('status', 'Depoimento excluído.');
    }
}
