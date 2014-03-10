<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Lsp_Controller_Template
{
    public $template = 'templates/default';

	public function action_index()
	{ 
        $this->template->content = View::factory('html/dashboard');
	}
}
