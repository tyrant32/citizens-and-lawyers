<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Criteria\ListAppointmentsCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\Citizens\АppointmentRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class AppointmentsController
 * @package App\Http\Controllers\API
 */
class AppointmentsController extends Controller
{
    
    /**
     * @var АppointmentRepository
     */
    protected $repository;
    
    /**
     * AppointmentsController constructor.
     */
    public function __construct(АppointmentRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $data['data'] = [];
        
        $data['data'] = $this->repository
            ->pushCriteria(ListAppointmentsCriteria::class)
            ->all()
            ->toArray();
        
        return response()->json($data);
    }
}
