<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IPermissionRepository;
use App\Permission;


class PermissionRepository extends ARepository implements IPermissionRepository
{

    protected $model = Permission::class;



}
