<?php
declare(strict_types=1);

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ListLawyersCriteria.
 *
 * @package namespace App\Criteria;
 */
class ListLawyersCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param  string  $model
     * @param  RepositoryInterface  $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
            ->join('users_roles', 'users_roles.id', '=', 'users.role_id')
            ->where('users_roles.slug', 'lawyer');
        
        return $model;
    }
}
