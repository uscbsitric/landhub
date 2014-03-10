<?php defined('SYSPATH') or die('No direct script access.');

class Model_Property_Photo extends ORM
{
    protected $_table_name = 'property_photos';

    protected $_belongs_to = array(
        'property' => array(
            'model' => 'Property',
            'foreign_key' => 'property_id',
        ),
    );
}