<?php defined('SYSPATH') or die('No direct script access.');

class FormField_Textarea extends FormField
{
    public function rules()
    {
        $field_name = $this->_field_obj->name;
        return Validation::factory(array($field_name => $this->$field_name))
            ->rule($this->_field_obj->name, 'not_empty')
            ->rule($this->_field_obj->name, 'min_length', array(':value', 10))
            ->rule($this->_field_obj->name, 'max_length', array(':value', 2000));
    }

    public function __toString()
    {
        return View::factory('html/form_fields/textarea')
            ->set('field', $this->_field_obj)
            ->render();
    }
}