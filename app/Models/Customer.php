<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
//    public function setUniqueIdAttribute()
//    {
//        return $this->unique_id = Str::uuid();
//    }
}
