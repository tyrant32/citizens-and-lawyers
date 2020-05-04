<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Transformers\AppointmentsStatusTransformer;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AppointmentsStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class AppointmentsStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return TransformerAbstract
     */
    public function getTransformer()
    {
        return new AppointmentsStatusTransformer();
    }
}
