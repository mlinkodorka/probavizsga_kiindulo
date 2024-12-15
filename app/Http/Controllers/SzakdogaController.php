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
        return Szakdoga::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $szakdoga=Szakdoga::find($id);
        $szakdoga->update($request->all);
        return $szakdoga;
    }

    public function destroy($id)
    {
        Szakdoga::find($id)->delete();
    }
}