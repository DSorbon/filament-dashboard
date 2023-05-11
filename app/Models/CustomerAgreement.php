<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAgreement extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'number',
        'agreement_date',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function uniqueIds()
    {
        return ['unique_id'];
    }
}
