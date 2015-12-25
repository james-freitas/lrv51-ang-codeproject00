<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 03/12/15
 * Time: 21:40
 */

namespace CodeProject\OAuth;

use Illuminate\Support\Facades\Auth;


class Verifier {

    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}