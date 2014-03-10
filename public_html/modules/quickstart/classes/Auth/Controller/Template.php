<?php defined('SYSPATH') or die('No direct script access.');

class Auth_Controller_Template extends Controller_Template
{
    // optional additional roles
    protected $_roles = array();

    protected $_user;

    public function before()
    {
        parent::before();

        try
        {
            Auth::evaluate_auth_controller_access($this->_roles);

            $this->_user = Auth::instance()->get_user();
        }
        catch(HTTP_Exception_401 $e)
        {
            Session::instance()->set('_Flash', $e->getMessage());
            $this->redirect('/login');
            exit();
        }
    }
}