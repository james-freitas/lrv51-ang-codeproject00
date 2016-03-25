<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 24/12/15
 * Time: 20:26
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $o)
    {
        return [
            'id' => $o->id,
            'project_id' => $o->project_id,
            'title' => $o->title,
            'note' => $o->note
        ];
    }
}