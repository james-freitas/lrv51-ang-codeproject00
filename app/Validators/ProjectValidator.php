<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 22:00
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator{

    protected $rules = [
        'owner_id' => 'required',
        'client_id'  => 'required',
        'name' => 'required',
        'description' => 'required',
        'progress' => 'required|numeric',
        'status' => 'in:Opened,Assigned,In Progress,Canceled,Finished',
        'due_date' => 'required'
    ];

}