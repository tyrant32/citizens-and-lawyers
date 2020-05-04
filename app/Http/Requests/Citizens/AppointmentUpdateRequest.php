<?php
declare(strict_types=1);

namespace App\Http\Requests\Citizens;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AppointmentUpdateRequest
 * @package App\Http\Requests\Citizens
 */
class AppointmentUpdateRequest extends FormRequest
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
