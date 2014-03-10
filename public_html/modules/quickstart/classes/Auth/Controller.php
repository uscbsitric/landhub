<?php defined('SYSPATH') or die('No direct script access.');

class Auth_Controller extends Controller
{
    // you do not need to include the login role
    protected $_roles = array();

    public function before()
    {
        parent::before();

        try
        {
            Auth::evaluate_auth_controller_access($this->_roles);
        }
        catch(HTTP_Exception_401 $e)
        {
            Session::instance()->set('_Flash', $e->getMessage());
            $this->redirect('/auth/login');
            exit();
        }
    }
}