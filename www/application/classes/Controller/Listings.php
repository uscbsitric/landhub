<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Listings extends Lsp_Controller_Template
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
	}

	public function action_new()
	{
		$states = ORM::factory('State')->find_all();
		$propertyID = $this->request->param('id');
		//$property = ORM::factory('Property')->where('id', '=', $propertyID)->find();

		$this->template->content = View::factory('html/listings/new')->set('states', $states)
																	 ->set('propertyID', $propertyID);
	}
	
	public function action_craigslist()
	{
		$properties = ORM::factory('Property')
						   ->where('user_id', '=', $this->_user->id)
						   ->find_all();
		
		$this->template->content = View::factory('html/listings/craigslist')->set('properties', $properties);
	}
	
	public function action_craigslistpreview()
	{
		$postVariables = $this->request->post();
		$property	   = ORM::factory('Property')->where('id', '=', $postVariables['propertyID'])->find();
		$state		   = ORM::factory('State')->where('abbreviation', '=', $postVariables['state'])->find();
		$city		   = ORM::factory('City')->where('id', '=', $postVariables['city'])->find();
		$propertyPhoto = ORM::factory('Property_Photo')->where('property_id', '=', $property->id)->find();
		$otherDetails  = array();
		$otherDetails['state'] = $state->name;
		$otherDetails['city']  = $city->name;
		$otherDetails['cityID']= $city->id;
		$otherDetails['propertyPhoto'] = $propertyPhoto;
		$this->template->content = View::factory('html/listings/craigslistpreview')->set('property', $property)
																				   ->set('otherDetails', $otherDetails);
	}
	
	public function action_craigslistpost()
	{
		$postVariables = $this->request->post();
		$listingsModel = ORM::factory('Listing');
		$listingsModel->postToCraigslist($postVariables);

		$this->template->content = View::factory('html/listings/craigslistpost');
		//$craigslistHandler = ORM::factory('Listings_CraigsListsHandler');
		//$craigslistHandler->postToCraigsList($postVariables['propertyID']);
	}
	
	public function action_youtube()
	{
		$this->template->content = View::factory('html/listings/youtube');
	}
	
	public function action_ebay()
	{
		$this->template->content = View::factory('html/listings/ebay');
	}


	public function action_getcities()
	{
		if( !$this->request->is_ajax() )
		{
			$this->redirect('listings/craigslist', 302);
		}
		$this->auto_render = FALSE;

		$stateID = $this->request->post('stateID');
		$cities = ORM::factory('City')->select(array('id', 'name'))->where('state_abbr', '=', $stateID)->find_all()->as_array('id', 'name');
		$jsonEncoded = json_encode($cities);
		

		//$this->request->headers('Content-type','application/json; charset='.Kohana::$charset);
		//$this->response->body($jsonEncoded);

		echo $jsonEncoded;
		exit();
	}
	
}