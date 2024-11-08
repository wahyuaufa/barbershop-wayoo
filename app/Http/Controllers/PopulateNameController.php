<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class PopulateNameController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari kolom name
        $names = DB::table('populate_name')->pluck('name');
        $names_choice = DB::table('choice_name')->pluck('name_pilihan');

        $data = [
            'names' => $names,
            'names_choice' => $names_choice,
        ];

        return response()->json($data);
    }
}
