<?php defined('SYSPATH') or die('No direct script access.');

abstract class FormFieldFactory
{
    public static function factory($field_obj)
    {
        $type = $field_obj->field_type;
        $class = 'FormField_'.ucfirst($type);
        return new $class($field_obj);
    }
}