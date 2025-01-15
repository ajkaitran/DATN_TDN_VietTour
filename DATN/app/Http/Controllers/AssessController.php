<?php

namespace App\Http\Controllers;

use App\Models\Assess;

class AssessController extends Controller
{
    public function index()
    {
        $assess = Assess::whereNull('deleted_at')->paginate(5);

        return view('assess.index', compact('assess'));
    }
    public function list()
    {
        $items = Assess::all();
        return response()->json($items);
    }
}
