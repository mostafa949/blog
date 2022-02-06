<?php

namespace App\Repository\Admin;


use App\Repository\BaseRepository;
use Modules\Admin\Entities\Admin;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Admin $model
     */
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}
