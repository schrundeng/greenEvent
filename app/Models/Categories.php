<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug'
    ];

    // Events relationship
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}