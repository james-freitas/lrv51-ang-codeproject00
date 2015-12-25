<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 22:00
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator{

    protected $rules = [
        'project_id'  => 'required',
        'name' => 'required',
        'start_date' => 'required',
        'due_date' => 'required'
    ];

}

