<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = ['metric_name', 'value', 'category', 'recorded_date'];

    protected $casts = [
        'value' => 'decimal:2',
        'recorded_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
