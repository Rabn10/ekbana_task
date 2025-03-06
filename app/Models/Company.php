<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'image',
        'description',
        'status',
        'delete_status',
    ];
}
