<?php
declare(strict_types=1);

namespace App\Http\Controllers\Lawyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lawyers\AppointmentUpdateRequest;
use App\Repositories\AppointmentsStatusRepository;
use App\Repositories\Lawyers\АppointmentRepository;
use App\Repositories\UserRepository;
use App\Validators\Lawyers\АppointmentValidator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function response;

/**
 * Class AppointmentsController
 * @package App\Http\Controllers\Lawyers
 */
class AppointmentsController extends Controller
{
    
    /**
     * @var UserRepository
     */
    protected $userRepository;
    
    /**
     * @var АppointmentRepository
     */
    protected $repository;
    
    /**
     * @var АppointmentValidator
     */
    protected $validator;
    
    /**
     * @var AppointmentsStatusRepository
     */
    protected $statusRepository;
    
    /**
     * AppointmentsController constructor.
     * @param  UserRepository  $userRepository
     * @param  АppointmentRepository  $repository
     * @param  AppointmentsStatusRepository  $statusRepository
     * @param  АppointmentValidator  $validator
     */
    public function __construct(UserRepository $userRepository, АppointmentRepository $repository, AppointmentsStatusRepository $statusRepository, АppointmentValidator $validator)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->repository = $repository;
        $this->statusRepository = $statusRepository;
        $this->validator = $validator;
    }
    
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('appointments.lawyer.index');
    }
    
    /**
     * @return Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        $appointment = $this->repository->find($id);
        
        if (isset($appointment->status->slug) && $appointment->status->slug === 'approved') {
            session()->flash('status', 'You can\'t edit approved appointment.');
            
            return redirect()->back();
        }
        
        $statuses = $this->statusRepository->all(['id', 'title']);
        
        return view('appointments.lawyer.request-edit', [
            'appointment' => $appointment,
            'statuses'    => $statuses,
        ]);
    }
    
    /**
     * @param  AppointmentUpdateRequest  $request
     * @return JsonResponse|RedirectResponse
     */
    public function update(AppointmentUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            $appointment = $this->repository->update($request->only([
                'status_id',
                'time',
            ]), $id);
            
            $response = [
                'message' => 'Appointment has been updated.',
                'data'    => $appointment->toArray()
            ];
            
            session()->flash('status', $response['message']);
            
            return redirect()->route('lawyer.appointments')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
    
    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $appointment = $this->repository->find($id);
        
        if (isset($appointment->status->slug) && $appointment->status->slug === 'approved') {
            session()->flash('status', 'You can\'t delete approved appointment.');
            
            return redirect()->back();
        }
        $appointment->delete();
        session()->flash('status', 'Appointment has been deleted.');
        
        return redirect()->back();
    }
    
}
