<?php defined('SYSPATH') or die('No direct script access.');

class Model_State extends ORM
{
    protected $_table_name = 'states';
    protected $_has_many = array('cities' => array('model' 		 => 'City',
    											   'foreign_key' => 'state_abbr'
    											  )
    							);
}