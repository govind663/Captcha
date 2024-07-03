<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaptchaCount extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'citizen_id',
        'captcha_id',
        'is_correct_captcha_count',
        'is_wrong_captcha_count',
        'per_captcha_amount',
        'inserted_by',
        'inserted_at',
        'modified_by',
        'modified_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    // ==== Relationship between Citizen
    public function citizen(){
        return $this->belongsTo(Citizen::class, 'citizen_id', 'id');
    }

    // ==== Relationship between Captcha
    public function captcha(){
        return $this->belongsTo(Captcha::class, 'captcha_id', 'id');
    }
}
