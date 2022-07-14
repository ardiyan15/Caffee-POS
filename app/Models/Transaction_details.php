<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction_details extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_details';

    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id')->withTrashed();
    }
}
