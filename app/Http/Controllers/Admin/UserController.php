<?php

namespace App\Http\Controllers\Admin;

use App\BusinessLogic\UserManager;
use App\Http\Controllers\Controller;
use App\ViewModels\UserViewModel;
use Illuminate\Http\Request;
use App\Entities\User;
use Exception;

class UserController extends Controller
{
    private $_userManager;

    public function __construct(UserManager $userManager)
    {
        $this->_userManager = $userManager;
    }

    public function index()
    {
        return view('admin.user_data.index');
    }

    public function getAllUsers(Request $request){
        $response = $this->_userManager->getAllUsers();
        return ($response);
    }

    public function getUserById(Request $request, $id)
    {
        $userId = $request->id;

        $userModel = $this->_userManager->getUserById($userId);

        $roles = $this->_userManager->getAllRoles();

        $view = view('admin.user_data._userDataPartialView', ["userModel"=>$userModel, "roles"=>$roles]);
        return response($view);
    }

    public function deleteUser(Request $request){
        try{
            $userId = $request->id;
            $this->_userManager->deleteUser($userId);

            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function editUser(Request $request){
        try{
            $newUser = new User();

            $newUser->setId($request->id);
            $newUser->setPassword($request->password);
            $newUser->setRememberToken($request->rememberToken);
            $newUser->setEmail($request->email);
            $newUser->setFullName($request->fullName);
            $newUser->setRoles($request->roles);

            $this->_userManager->editUser($newUser);
            return $this->jsonSuccessResult(null);
        }
        catch(Exception $e){
            return $this->jsonFaultResult([$e->getMessage()]);
        }
    }

    public function editUserRole(Request $request){

      $rolesToAdd = array();

      $userId = $request->userId;

      $admin = $request->admin_;
      if (!empty($admin)) {
          array_push($rolesToAdd, $admin);
      }

      $worker = $request->worker_;
      if (!empty ($worker)) {
          array_push($rolesToAdd, $worker);
      }

      $customer = $request->customer_;
      if (!empty ($customer)) {
          array_push($rolesToAdd, $customer);
      }

      $this->_userManager->UpdateUserRoles($userId,$rolesToAdd);
      return $this->jsonSuccessResult(null);

    }

    public function getPaginatedUsers(Request $request)
    {
        $paginatedUsers = $this->_userManager->getPaginetedUsers($request->pageSize, $request->page);

        return ['users' => $paginatedUsers->getData(), 'total' => $paginatedUsers->getCount()];
    }


}
