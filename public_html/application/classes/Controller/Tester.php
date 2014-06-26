<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tester extends Lsp_Controller_Template
{
	public $template = 'templates/default';
	
	/***
	public function before()
	{
		$this->auto_render = ! $this->request->is_ajax();
	
		if($this->auto_render === TRUE)
		{
			parent::before();
		}
	}
	***/
	
	public function action_index()
	{
		var_dump( $this->UniqueRandomNumbersWithinRange(1, 12, 1) );
		
		echo "<br>";
		exit('frederick debugging here --- inside Controller_Test -> action_index()');
	}
}