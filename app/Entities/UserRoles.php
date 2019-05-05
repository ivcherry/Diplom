<?php
namespace App\Entities;

class UserRoles
{
    const Admin = "admin";

    const Customer = "customer";

    const Worker = "worker";

    const Guest = "guest";

    public static function getDefaultWayByRole($role)
    {
        switch ($role)
        {
            case self::Admin:
            {
                return '/admin';
            }

            case self::Customer:
            {
                return '/';
            }

            case self::Worker:
            {
                return '/worker';
            }

            case self::Guest:
            {
                return '/login';
            }
        }
    }
}