<?php
/**
 * Created by PhpStorm.
 * User: trust2
 * Date: 11/09/19
 * Time: 10.20
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APILoginController extends Controller
{

    public function index(Request $request)
    {
        try{

            $attempt = ['email' => $request->email, 'password' => $request->password];
            $user = Auth::guard('web')->attempt($attempt);
            if(!$user)
                throw new \Exception('data tidak ada');

            $http = new Client();
            $response = $http->post('http://lara56.local/oauth/token',[
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => 'X9kIXvXVw4mJ7W99sklPoNzNA6hi4jkrhLYXfUHn',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
                ],
            ]);

            $user = User::where('email',$request->email)->first();

            $data = json_decode($response->getBody());

            $user->token = [
                'access_token' => $data->access_token,
                'expires_in' => $data->expires_in
            ];

            $response = [
                'status' => 200,
                'data' => $user
            ];

            return response()->json($response);

        }catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return 'ok';
    }

    public function test()
    {
        return 'test';
    }

}