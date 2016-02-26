<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 22:00
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator{

    protected $rules = [
        'project_id' => 'required',
        'title'  => 'required',
        'note' => 'required',
    ];

}

