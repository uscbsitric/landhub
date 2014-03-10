<?php defined('SYSPATH') OR die('No direct access allowed.');

class Lsp_Controller_Template extends Auth_Controller_Template
{
    protected $_user;

    protected $_vertical;

    public function before()
    {
        parent::before();

        $this->_user = Auth::instance()->get_user();
    }

    public function after()
    {
        $this->template->content->set('user', @$this->_user);
        $this->template->set('user', @$this->_user);

        parent::after();
    }
}