<?php

namespace App\Http\Controllers;

use App\Models\Formula;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    public function index()
    {
        return response()->json(Formula::orderBy('tipo')->get());
    }

    public function show($id)
    {
        return response()->json(Formula::findOrFail($id));
    }
}
