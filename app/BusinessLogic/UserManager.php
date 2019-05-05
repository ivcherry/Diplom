<?php

namespace App\BusinessLogic;

use App\Entities\User;
use App\Entities\Role;
use App\Repositories\UnitOfWork\UnitOfWork;
use App\ViewModels\UserViewModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\ArrayCollection;


class UserManager
{
    private $_unitOfWork;

    public function __construct(UnitOfWork $unitOfWork)
    {
        $this->_unitOfWork = $unitOfWork;
    }

    public function createUser(User $user)
    {
        if ($user == null) {
            throw new Exception("Невозможно создать пользователя.");
        }

        if (empty($user->getEmail())) {
            throw new Exception("Невозможно создать пользователя. Электронная почта отсутствует");
        }

        $existingUser = $this->_unitOfWork->userRepository()->findUserByEmail($user->getEmail());

        if (isset($existingUser)) {
            throw new Exception("Пользователь с электронной почтой" . $existingUser->getEmail() . "уже существует.");
        }

        $user->setPassword(bcrypt($user->getPassword()));

        $this->_unitOfWork->userRepository()->create($user);

        $this->_unitOfWork->commit();

        return $this->_unitOfWork->userRepository()->findUserByEmail($user->getEmail());
    }

    public function getUserById($id)
    {
        return $this->_unitOfWork->userRepository()->get($id);
    }

    public function getRoleById($id)
    {
        return $this->_unitOfWork->roleRepository()->get($id);
    }

    public function addRoleToUser(User $user, Role $role)
    {
        if ($user == null) {
            throw new Exception("Не указан пользователь, которому присваивается роль.");
        }
        if ($role == null) {
            throw new Exception("Не указана роль, которая присваивается пользователю.");
        }

        $user->addRole($role);
        $role->addUser($user);

        $this->_unitOfWork->commit();
    }

    public function UpdateUserRoles($userId, $rolesToAdd)
    {

        $user = $this->_unitOfWork->userRepository()->get($userId);
        if (!isset($user)) { throw new Exception("Пользователь с $userId не найдет"); }

        $user->resetRoles();


        $roles = new ArrayCollection();

        foreach ($rolesToAdd as $roleId) {
            $role = $this->_unitOfWork->roleRepository()->get($roleId);
            if (isset($role)) {
                    $user->addRole($role);
            }
        }

        $this->_unitOfWork->commit();
    }

    public function getCurrentUser()
    {
        $currentUser = Auth::user();

        if ($currentUser == null) {
            throw new Exception("Пользователь не аутентифицирован.");
        }

        $userViewModel = new UserViewModel();
        $userViewModel->fillFrom($currentUser);

        return $userViewModel;
    }

    public function checkCurrentUserToValidRoles($roles)
    {

        $currentUser = Auth::user();

        if ($currentUser == null) {
            throw new Exception("Пользователь не аутентифицирован.");
        }

        $availableRoles = explode('|', $roles);

        if ($currentUser->getRoles()->isEmpty()) {

            throw new Exception("Пользователю не назначена роль.");
        }

        $currentUserRoles = $currentUser
            ->getRoles()
            ->map(function ($role) {
                return $role->getName();
            });

        foreach ($availableRoles as $availableRole) {
            if ($currentUserRoles->contains($availableRole)) {
                return true;
            }
        }
        return false;
    }

    public function getCurrentUserRoles()
    {
        $currentUser = Auth::user();

        if ($currentUser == null) {
            throw new Exception("Пользователь не аутентифицирован.");
        }

        if ($currentUser->getRoles()->isEmpty()) {
            throw new Exception("Пользователю не назначена роль.");
        }

        return $currentUser->getRoles();
    }

    public function getAllRoles()
    {
        return $this->_unitOfWork->roleRepository()->all();
    }

    public function getAllUsers()
    {
        return $this->_unitOfWork->userRepository()->all();
    }

    public function editUser(User $newUser){
        if(empty($newUser->getId())){
          throw new Exception("Невозможно изменить. Не указан идентификатор");
        }

        if(empty($newUser->getFullName())){
          throw new Exception("Невозможно изменить. Не указано имя");
        }
        $this->_unitOfWork->userRepository()->update($newUser);
        $this->_unitOfWork->commit();
    }

    public function deleteUser($id){
        if(empty($id)){
          throw new Exception("Невозможно удалить. Отсуствует идентификатор.");
        }

        $user = $this->_unitOfWork->userRepository()->get($id);
        if(!isset($feature)){
          throw new Exception("Невозможно удалить. Идентификатор $id не найден.");
        }
        $this->_unitOfWork->userRepository()->delete($user);
        $this->_unitOfWork->commit();
    }

    public function getPaginetedUsers($pageSize, $pageNumber){
        $users = new ArrayCollection();
        $paginatedUsers = $this->_unitOfWork->userRepository()->getPaginatedUsers($pageSize, $pageNumber);
        foreach($paginatedUsers->getData() as $user)
        {
            $users->add($user->jsonSerialize());
        }
        $paginatedUsers->setData($users->toArray());
        return $paginatedUsers;
    }
}
