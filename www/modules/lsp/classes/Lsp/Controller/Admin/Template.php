<?php defined('SYSPATH') OR die('No direct access allowed.');

class Lsp_Controller_Admin_Template extends Lsp_Controller_Template
{
    public function before()
    {
        parent::before();

        if (!$this->_user->has('roles', ORM::factory('Role', array('name' => 'admin'))))
            throw new HTTP_Exception_403('Forbidden');
    }
}