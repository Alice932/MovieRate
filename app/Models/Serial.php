<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;
    protected $table = 'serials';
    protected $fillable = ['title', 'country', 'time', 'creator', 'genre', 'rating', 'episodes', 'seasons' ,'actors', 'content', 'format', 'image'];
}
