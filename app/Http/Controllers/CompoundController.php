<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class CompoundController extends Controller
{
    /**
     * @param Request $request
     * @param $text
     * @return Response
     */
    public function show(Request $request, $text): Response
    {
        $response = Http::get("https://pubchem.ncbi.nlm.nih.gov/rest/autocomplete/compound/{$text}/json?limit=6");
        return $response->json();
    }
}
