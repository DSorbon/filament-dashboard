<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPassport extends Model
{
    use HasFactory;

    protected $fillable = [
        'series',
        'number',
        'date_of_issue',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];
}
