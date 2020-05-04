<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Transformers\UsersRoleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UsersRolePresenter.
 *
 * @package namespace App\Presenters;
 */
class UsersRolePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return UsersRoleTransformer
     */
    public function getTransformer()
    {
        return new UsersRoleTransformer();
    }
}
