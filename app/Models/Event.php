<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
        'start_date',
        'end_date',
        'location',
        'longitude',
        'latitude',
        'poster',
        'organizer',
        'created_by',
        'slug',
    ];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'longitude' => 'decimal:7',
        'latitude' => 'decimal:7'
    ];

    protected $attributes = [
        'status' => 'draft',
        // 'coming_soon',
        // 'ongoing',
        // 'ended',
        // 'cancelled'
    ];

    // Relationship with User model
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship with Category model
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
