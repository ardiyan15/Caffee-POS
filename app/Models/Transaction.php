<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'taken_by');
    }

    public function transaction_details()
    {
        return $this->hasMany(Transaction_details::class, 'transaction_id');
    }
}
