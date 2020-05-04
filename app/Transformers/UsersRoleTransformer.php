<?php
declare(strict_types=1);

namespace App\Transformers;

use App\Entities\UsersRole;
use League\Fractal\TransformerAbstract;

/**
 * Class UsersRoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class UsersRoleTransformer extends TransformerAbstract
{
    /**
     * Transform the UsersRole entity.
     *
     * @param  UsersRole  $model
     *
     * @return array
     */
    public function transform(UsersRole $model)
    {
        return [
            'id' => (int) $model->id,
            
            /* place your other model properties here */
            
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
