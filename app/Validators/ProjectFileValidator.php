<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 22:00
 */

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator{

    protected $rules = [

        ValidatorInterface::RULE_CREATE => [
            'project_id' => 'required',
            'name' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,gif,pdf,zip',
            'description' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'project_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]

    ];

}

