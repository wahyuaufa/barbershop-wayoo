<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Name;
use App\Models\ChoiceName;

class RandomNameController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function resetNames()
    {
        // Menghapus semua data dari tabel populate_name
        \App\Models\Name::truncate();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'All names have been successfully deleted.');
    }


    public function index()
    {
        $names = DB::table('populate_name')->get();
        $targetNames = DB::table('choice_name')->get();
        return view('random_names/index', compact('names', 'targetNames'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:populate_name,name', // Ganti your_table_name dengan nama tabel yang sesuai
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('populate_name')->insert(['name' => $request->name]);

        return redirect()->route('random-names.index')->with('success', 'Name added successfully!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Mengambil file CSV
        $file = $request->file('csv_file');
        $path = $file->store('csv');

        // Membaca file CSV
        $data = array_map('str_getcsv', file(storage_path('app/' . $path)));

        // Menyimpan nama ke database
        foreach ($data as $row) {
            if (isset($row[0])) {
                DB::table('populate_name')->insert(['name' => $row[0]]);
            }
        }

        return redirect()->route('random-names.index')->with('success', 'Names uploaded successfully!');
    }

    public function addToTarget($id)
    {
        // Tambahkan nama ke tabel choice_name
        $name = Name::find($id);

        if ($name) {
            DB::table('choice_name')->insert(['name_pilihan' => $name->name]);
        }

        return redirect()->back();
    }

    public function deleteFromTarget($id)
    {
        // Hapus nama dari tabel choice_name
        $targetName = ChoiceName::find($id);

        if ($targetName) {
            $targetName->delete();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $name = Name::findOrFail($id); // Mencari nama berdasarkan ID
        $name->delete(); // Menghapus nama

        return redirect()->back()->with('success', 'Name deleted successfully.');
    }
}
