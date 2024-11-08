<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AddName extends Controller
{
    public function index()
    {
        $names = DB::table('populate_name')->get();
        return view('add-name/index', compact('names'));
    }
}
