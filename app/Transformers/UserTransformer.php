<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param  User  $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int) $model->id,
            
            /* place your other model properties here */
            
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
