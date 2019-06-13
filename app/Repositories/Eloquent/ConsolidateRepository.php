<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IConsolidateRepository;
use App\Consolidate;


class ConsolidateRepository extends ARepository implements IConsolidateRepository
{

    protected $model = Consolidate::class;

}
