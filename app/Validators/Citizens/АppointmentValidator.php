<?php
declare(strict_types=1);

namespace App\Validators\Citizens;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class АppointmentValidator.
 *
 * @package namespace App\Validators\Citizens;
 */
class АppointmentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'lawyer_id' => 'required|integer',
            'time'      => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'lawyer_id' => 'required|integer',
            'time'      => 'required',
        ],
    ];
}
