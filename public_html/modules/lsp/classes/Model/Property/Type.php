<?php defined('SYSPATH') or die('No direct script access.');

class Model_Property_Type extends ORM
{
    protected $_table_name = 'property_types';

    protected $_has_many = array(
        'properties' => array(
            'model' => 'Property',
            'foreign_key' => 'property_type_id',
        ),
    );
}