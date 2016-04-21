<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 25/12/15
 * Time: 07:39
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }

}