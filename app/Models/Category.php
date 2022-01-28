<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $availableFields = ['id', 'title', 'slug', 'description', 'created_at'];

    public function getCategories(): array
    {
        return DB::table($this->table)
            ->select($this->availableFields)
            ->limit(100)
            ->get()
            ->toArray();
    }
}
