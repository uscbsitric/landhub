<?php defined('SYSPATH') or die('No direct script access.');

class Model_City extends ORM
{
    protected $_table_name = 'cities';
    protected $_belongs_to = array('state' => array('model' 	  => 'State',
    												'foreign_key' => 'state_abbr'
    											   )
    							  );
}