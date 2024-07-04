<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CitizenPayment extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'transaction_id',
        'citizen_id',
        'email',
        'amount',
        'bank_name',
        'branch_name',
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'payment_mode',
        'transaction_status',
        'transaction_date',
        'transaction_time',
        'notes',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];
}
