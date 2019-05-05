<?php

namespace App\Http\Controllers\Auth;

use App\BusinessLogic\UserManager;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $_userManager;

    public function index()
    {
        return view("auth.register");
    }

    public function __construct(UserManager $userManager)
    {
        $this->_userManager = $userManager;
        $this->middleware('guest');
    }

//    public function register(Request $request)
//    {
//        try
//        {
//            $user = new User();
//            $user->setEmail($request->email);
//            $user->setFullName($request->fullName);
//            $user->setPassword($request->password);
//
//            $createdUser = $this->_userManager->CreateUser($user);
//
//            if (empty($createdUser))
//            {
//                throw new Exception("Не удалось зарегистрировать пользователя.");
//            }
//
//            event(new Registered($createdUser));
//
//            $this->guard()->login($user);
//
//            return redirect($this->redirectTo);
//
//        }
//        catch(Exception $exception)
//        {
//            dd($exception);
//            return $this->index();
//        }
//    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        try {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setFullName($data['fullName']);
            $user->setPassword($data['password']);

            $createdUser = $this->_userManager->createUser($user);

            if (empty($createdUser)) {
                throw new Exception("Не удалось зарегистрировать пользователя.");
            }
            return $createdUser;
        } catch (Exception $exception) {
            dd($exception);
            return $this->index();
        }
    }
}
