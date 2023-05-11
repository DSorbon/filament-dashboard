<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'unique_id',
        'name',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function uniqueIds()
    {
        return ['unique_id'];
    }

    public function passport()
    {
        return $this->hasOne(CustomerPassport::class);
    }

    public function agreement()
    {
        return $this->hasOne(CustomerAgreement::class);
    }

    public function getDocumentsCountAttribute()
    {
        return count($this->documents);
    }
}
