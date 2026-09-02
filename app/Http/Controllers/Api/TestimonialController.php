<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $depoimentos = Testimonial::orderBy('publicado')->latest()->get();

        return response()->json(['data' => $depoimentos]);
    }

    public function approve(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['publicado' => true]);

        return response()->json(['data' => $testimonial]);
    }

    public function unpublish(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['publicado' => false]);

        return response()->json(['data' => $testimonial]);
    }

    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $testimonial->delete();

        return response()->json(['message' => 'Depoimento excluído.']);
    }
}
