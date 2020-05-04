<?php
declare(strict_types=1);

namespace App\Http\Controllers\Citizens;

use App\Criteria\ListLawyersCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Citizens\AppointmentCreateRequest;
use App\Http\Requests\Citizens\AppointmentUpdateRequest;
use App\Repositories\Citizens\АppointmentRepository;
use App\Repositories\UserRepository;
use App\Validators\Citizens\АppointmentValidator;
use Auth;
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
 * @package App\Http\Controllers\Citizens
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
     * AppointmentsController constructor.
     * @param  UserRepository  $userRepository
     * @param  АppointmentRepository  $repository
     */
    public function __construct(UserRepository $userRepository, АppointmentRepository $repository, АppointmentValidator $validator)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('appointments.citizen.index');
    }
    
    /**
     * @return Factory|View
     */
    public function request()
    {
        $lawyers = $this->userRepository
            ->pushCriteria(ListLawyersCriteria::class)
            ->all(['users.id', 'users.name']);
        
        return view('appointments.citizen.request', [
            'lawyers' => $lawyers
        ]);
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
        
        $lawyers = $this->userRepository
            ->pushCriteria(ListLawyersCriteria::class)
            ->all(['users.id', 'users.name']);
        
        return view('appointments.citizen.request-edit', [
            'lawyers'     => $lawyers,
            'appointment' => $appointment
        ]);
    }
    
    /**
     * @param  AppointmentCreateRequest  $request
     * @return JsonResponse|RedirectResponse
     */
    public function create(AppointmentCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            $request->merge([
                'user_id' => Auth::id()
            ]);
            
            $appointment = $this->repository->create($request->only([
                'user_id',
                'lawyer_id',
                'time'
            ]));
            
            $response = [
                'message' => 'Appointment has been created.',
                'data'    => $appointment->toArray()
            ];
            
            session()->flash('status', $response['message']);
            
            return redirect()->route('citizen.appointments')->with('message', $response['message']);
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
     * @param  AppointmentUpdateRequest  $request
     * @return JsonResponse|RedirectResponse
     */
    public function update(AppointmentUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            $request->merge([
                'user_id' => Auth::id()
            ]);
            
            $appointment = $this->repository->update($request->only([
                'user_id',
                'lawyer_id',
                'time'
            ]), $id);
            
            $response = [
                'message' => 'Appointment has been updated.',
                'data'    => $appointment->toArray()
            ];
            
            session()->flash('status', $response['message']);
            
            return redirect()->route('citizen.appointments')->with('message', $response['message']);
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
