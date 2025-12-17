<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'address',
        'map_url',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];
}
