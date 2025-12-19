<?php

namespace App\Repositories\Eloquent;

use App\Models\CtaSection;
use App\Repositories\Interfaces\CtaRepositoryInterface;

class CtaRepository extends BaseRepository implements CtaRepositoryInterface
{
    public function __construct(CtaSection $model)
    {
        parent::__construct($model);
    }
}
