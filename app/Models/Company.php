<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyCategory;

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

    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'category_id', 'id');
    }
}
