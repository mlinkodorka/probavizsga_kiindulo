<?php

namespace App\Http\Controllers;

use App\Models\Szakdoga;
use Illuminate\Http\Request;

class SzakdogaController extends Controller
{
    public function index()
    {
        return Szakdoga::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'szakdoga_nev' => 'required|string',
            'githublink' => 'required',
            'oldallink' => 'required',
            'tagokneve' => 'required|string',
        ]);
        return Szakdoga::create($validated);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'szakdoga_nev' => 'required|string',
            'githublink' => 'required',
            'oldallink' => 'required',
            'tagokneve' => 'required|string',
        ]);

        $szakdoga = Szakdoga::findOrFail($id);
        $szakdoga->update($validated);
        return $szakdoga;
    }

    // DELETE - szakdoga törlése
    public function destroy($id)
    {
        Szakdoga::find($id)->delete();

    }
}
