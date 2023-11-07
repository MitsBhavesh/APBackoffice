<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arham_data;


class Arham_data extends Model
{
    use HasFactory;
    protected $table = 'tbl_updatedata';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'title',
        'description',
        'image',
        'm_link',
    ];
}
