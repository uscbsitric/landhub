<?php defined('SYSPATH') or die('No direct script access.');

class Model_Listing extends ORM
{
    protected $_table_name = 'listings';

	public function postToCraigslistPart1($postVariables, $userId)
	{
		$property 		   = ORM::factory('Property')->where('id', '=', $postVariables['propertyID'])->find();
		$city	  		   = ORM::factory('City')->where('id', '=', $postVariables['cityID'])->find();
		$configuration 	   = array('emailAddress' => '',
								   'password'	  => ''
								  );
		$craigslistHandler = new Model_Listings_CraigsListsHandler($configuration);
		//$craigslistHandler = ORM::factory('Listings_CraigsListsHandler');
		exit('Frederick Sandalo Finalizing Here');

		$craigslistHandler->postToCraigslistPart1($property, $city, $userId, true);
	}
    
    
	public function postToCraigslistPart2($verificationCode)
	{
		$craigslistHandler = ORM::factory('Listings_CraigsListsHandler');

		$craigslistHandler->postToCraigslistPart2($verificationCode);
	}
}