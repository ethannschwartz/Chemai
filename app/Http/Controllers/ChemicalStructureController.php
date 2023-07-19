<?php

namespace App\Http\Controllers;

use App\Models\Compound;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChemicalStructureController extends Controller
{
    /**
     * @param Compound $compound
     * @return Response
     */
    public function show(Compound $compound): Response
    {
        return Inertia::render('Compound/Show', [
            'compound' => $compound,
        ]);
    }

    public function store(Request $request, $text): RedirectResponse
    {
        $request->user()->compounds()->create([
            'smile' => $text,
            'img_url' => "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/smiles/{$text}/PNG",
        ]);
        return back();
    }

    /**
     * @param Request $request
     * @param $text
     * @return RedirectResponse
     */
    public function destroy(Request $request, $text): RedirectResponse
    {
        $request->user()->compounds()->where('smile', '=', $text)->delete();
        return back();
    }
}
