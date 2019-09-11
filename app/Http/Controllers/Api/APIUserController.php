<?php
/**
 * Created by PhpStorm.
 * User: trust2
 * Date: 11/09/19
 * Time: 10.40
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class APIUserController extends Controller
{

    public function index()
    {
        $user = Auth::guard('api')->user();
        if(!$user)
            return 'gagal masuk';

        return $user;
    }

}