<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 05/09/15
 * Time: 08:37
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends  LaravelValidator {

    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required'
    ];
}