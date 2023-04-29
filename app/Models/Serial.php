<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;
    protected $table = 'serials';
    protected $fillable = ['title', 'creator', 'genre', 'rating', 'episodes', 'seasons', 'content', 'format', 'image'];
}
