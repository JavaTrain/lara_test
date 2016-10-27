<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email','password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return $this->response->errorUnauthorized();
            }
        }catch(JWTException $e){
            return $this->response->errorInternal();
        }

        return $this->response->array(compact('token'))->setStatusCode(200);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return User::all();
    }

    /**
     *
     */
    public function show()
    {
        try{
            $user = JWTAuth::parseToken()->toUser();
            if(!$user){
                return $this->response->errorNotFound('User not found');
            }
        } catch(JWTException $e){
            return $this->response->error('Something went wrong');
        }

        return $this->response->array(compact('user'))->setStatusCode(200);
    }

    /**
     * @return mixed
     */
    public function getToken(){
        $token = JWTAuth::getToken();
        if(!$token){
            $this->response->errorUnauthorized('Token is invalid');
        }

        try{
            $refreshToken = JWTAuth::refresh($token);
        }catch(JWTException $e){
            $this->response->error('Something went wrong');
        }

        return $this->response->array(compact('refreshToken'));
    }

    /**
     *
     */
    public function destroy()
    {
        $user = JWTAuth::parseToken();
        if(!$user){
            ///
        }

        $user->delete();
    }

}
