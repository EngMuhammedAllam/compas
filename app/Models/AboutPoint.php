<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPoint extends Model
{
    protected $table = 'about_points';
    protected $guarded = [];

    public function aboutSection()
    {
        return $this->belongsTo(AboutSection::class);
    }
}
