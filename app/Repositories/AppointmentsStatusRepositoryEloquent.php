<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\AppointmentsStatus;
use App\Validators\AppointmentsStatusValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AppointmentsStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AppointmentsStatusRepositoryEloquent extends BaseRepository implements AppointmentsStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AppointmentsStatus::class;
    }
    
    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        
        return AppointmentsStatusValidator::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
