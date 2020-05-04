<?php
declare(strict_types=1);

namespace App\Http\Requests\Citizens;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AppointmentCreateRequest
 * @package App\Http\Requests\Citizens
 */
class AppointmentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lawyer_id' => 'required|integer',
            'time'      => 'required',
        ];
    }
}
