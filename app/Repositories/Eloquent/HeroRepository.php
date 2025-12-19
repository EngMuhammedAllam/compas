<?php

namespace App\Repositories\Eloquent;

use App\Models\HeroSection;
use App\Repositories\Interfaces\HeroRepositoryInterface;

class HeroRepository extends BaseRepository implements HeroRepositoryInterface
{
    public function __construct(HeroSection $model)
    {
        parent::__construct($model);
    }
}
