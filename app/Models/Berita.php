<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','genre_id','title','description','cover'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
}