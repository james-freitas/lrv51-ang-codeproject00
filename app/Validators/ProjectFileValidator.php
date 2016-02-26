<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 22:00
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator{

    protected $rules = [
        'project_id' => 'required',
        'name' => 'required',
        'file' => 'required|mimes:jpeg,jpg,png,gif,pdf,zip,',
        'description' => 'required'
    ];

}

