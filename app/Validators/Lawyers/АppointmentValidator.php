<?php
declare(strict_types=1);

namespace App\Validators\Lawyers;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class АppointmentValidator.
 *
 * @package namespace App\Validators\Lawyers;
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
            'status_id' => 'required|integer',
            'time'      => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'status_id' => 'required|integer',
            'time'      => 'required',
        ],
    ];
}
