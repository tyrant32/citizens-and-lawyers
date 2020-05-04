<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\UsersRole;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UsersRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UsersRoleRepositoryEloquent extends BaseRepository implements UsersRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersRole::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
