<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    // Tabel terkait dengan model ini (secara default, Laravel akan mengasumsikan tabel 'names')
    protected $table = 'populate_name';

    // Field yang dapat diisi (mass assignable)
    protected $fillable = ['name'];

    // Tambahkan relasi atau metode lain jika diperlukan
}
