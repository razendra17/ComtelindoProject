<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Data::with('package.city')->get();
        return response()->json($data);
    }
    
    public function create() {}
    public function update() {}
    public function destroy() {}
}
