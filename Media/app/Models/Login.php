<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'Login';
    protected $primaryKey = 'id';
    protected $fillable = [
        'apcode',
        'password'
    ];
}
