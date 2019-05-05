<?php

namespace App\Http\Middleware;

use App\BusinessLogic\UserManager;
use App\Entities\UserRoles;
use Closure;
use Exception;

class CheckUserRole
{
    protected $_userManager;

    public function __construct(UserManager $userManager)
    {
        $this->_userManager = $userManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        try
        {
            $isValidRoute = $this->_userManager->checkCurrentUserToValidRoles($roles);

            if ($isValidRoute)
            {
                return $next($request);
            }
            else
            {
                $defaultRoute = $this->_userManager
                                ->getCurrentUserRoles()
                                ->first()
                                ->getName();

                return redirect(UserRoles::getDefaultWayByRole($defaultRoute));
            }

        }
        catch (Exception $ex)
        {
            return redirect(UserRoles::getDefaultWayByRole(UserRoles::Guest));
        }
    }

}
