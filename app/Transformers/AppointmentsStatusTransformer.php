<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Entities\AppointmentsStatus;
use League\Fractal\TransformerAbstract;

/**
 * Class AppointmentsStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class AppointmentsStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the AppointmentsStatus entity.
     *
     * @param  AppointmentsStatus  $model
     *
     * @return array
     */
    public function transform(AppointmentsStatus $model)
    {
        return [
            'id' => (int) $model->id,
            
            /* place your other model properties here */
            
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
