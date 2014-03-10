<?php defined('SYSPATH') or die('No direct script access.');

abstract class FormFieldCollectionFactory
{
    public static function factory($vertical_id)
    {
        $vertical = ORM::factory('Vertical', array('id' => $vertical_id));

        if (!$vertical->loaded()) throw new Exception('No such vertical');

        $fields = $vertical->fields->find_all();

        $list = array();

        foreach($fields as $field)
        {
            $list[] = FormFieldFactory::factory($field);
        }

        return new FormFieldCollection($list);
    }
}