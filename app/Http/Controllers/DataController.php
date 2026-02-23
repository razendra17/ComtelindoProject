<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Packages;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function create()
    {
        $packages = Packages::all();
        return view('pages.forms.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'package_id' => 'required|exists:packages,id',
        ]);

        Data::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'package_id' => $request->package_id,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
