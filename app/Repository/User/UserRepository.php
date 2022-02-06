<?php

namespace App\Repository\User;


use App\Repository\BaseRepository;
use Modules\User\Entities\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
