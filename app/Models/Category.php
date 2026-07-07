<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function finishing()
    {
        return $this->hasMany(Finishing::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
}
