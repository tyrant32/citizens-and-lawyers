<?php
declare(strict_types=1);

namespace App\Criteria;

use Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ListAppointmentsCriteria.
 *
 * @package namespace App\Criteria;
 */
class ListAppointmentsCriteria implements CriteriaInterface
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
        if (Auth::user()->isCitizen()) {
            $model = $model
                ->select('аppointments.id as DT_RowId', 'time', 'users.name', 'appointments_statuses.title as status', 'аppointments.updated_at')
                ->from('аppointments')
                ->join('users', 'users.id', '=', 'аppointments.lawyer_id')
                ->leftJoin('appointments_statuses', 'appointments_statuses.id', '=', 'аppointments.status_id')
                ->where('аppointments.user_id', Auth::id())
                ->orderBy('аppointments.updated_at', 'desc')
                ->limit(1000);
        }
        
        if (Auth::user()->isLawyer()) {
            $model = $model
                ->select('аppointments.id as DT_RowId', 'time', 'users.name', 'appointments_statuses.title as status', 'аppointments.updated_at')
                ->from('аppointments')
                ->join('users', 'users.id', '=', 'аppointments.user_id')
                ->leftJoin('appointments_statuses', 'appointments_statuses.id', '=', 'аppointments.status_id')
                ->where('аppointments.lawyer_id', Auth::id())
                ->orderBy('аppointments.updated_at', 'desc')
                ->limit(1000);
        }
        
        return $model;
    }
}
