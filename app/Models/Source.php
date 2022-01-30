<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';

    public static $availableFields = [
        'id',
        'title',
        'description',
        'created_at'
    ];

    protected $fillable = [
        'title',
        'description'
    ];
}
