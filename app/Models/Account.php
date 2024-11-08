<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'accounts';  // Menyebutkan nama tabel jika tidak default
    protected $fillable = ['user_name', 'password'];  // Kolom yang dapat diisi
}