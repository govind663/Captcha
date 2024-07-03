<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Captcha extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'citizen_id',
        'captcha_type_id',
        'captcha_length',
        'captcha_code',
        'is_active',
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

    // ==== Relationship between Captcha Type
    public function captchaType(){
        return $this->belongsTo(CaptchaType::class, 'captcha_type_id', 'id');
    }
}
