<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class CompanyCategory extends Model
{
    protected $fillable = [
        'title',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'category_id', 'id');
    }
}
