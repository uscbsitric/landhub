<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Auth extends Kohana_Auth
{
    public static function evaluate_auth_controller_access($roles = array())
    {
        $has_access = false;

        if (!Auth::instance()->logged_in('login'))
            throw new HTTP_Exception_401(__('You must be logged in to view this page'));

        $user = Auth::instance()->get_user();

        // if we specify a non-login role, user must have at least one of the $_roles to continue

        if (!empty($roles))
        {
            foreach($roles as $role)
            {
                if ($user->has('roles', ORM::factory('Role', array('name' => $role))))
                {
                    $has_access = true;
                    break;
                }
            }

            if (!$has_access)
                throw new HTTP_Exception_401(__('You do not have sufficient privileges to view this page'));
        }
    }
}