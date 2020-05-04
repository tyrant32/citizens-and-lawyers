<?php
declare(strict_types=1);

namespace App\Repositories\Lawyers;

use App\Entities\Аppointment;
use App\Validators\Lawyers\АppointmentValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class АppointmentRepositoryEloquent
 * @package App\Repositories\Lawyers
 */
class АppointmentRepositoryEloquent extends BaseRepository implements АppointmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Аppointment::class;
    }
    
    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return АppointmentValidator::class;
    }
    
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
