<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;

class CompoundController extends Controller
{

    public function search(Request $request, $text)
    {
        $response = Http::get("https://pubchem.ncbi.nlm.nih.gov/rest/autocomplete/compound/{$text}/json?limit=6");
        return Inertia::render('Dashboard', [
            'recent_compounds' => Auth::user()->compounds()->orderBy('created_at', 'desc')->limit(4)->get(),
            'search_results' => $response->json(),
        ]);
    }
}
