<?php defined('SYSPATH') or die('No direct script access.');

class FormField_Multiselect extends DataSourceField
{
    public function rules()
    {
        $field_name = $this->_field_obj->name;
        return Validation::factory(array($field_name => $this->$field_name))
            ->rule($this->_field_obj->name, 'not_empty')
            ->rule($this->_field_obj->name, 'in_array', array(':value', array_keys($this->data())));
    }

    public function __toString()
    {
        return View::factory('html/form_fields/multiselect')
            ->set('field', $this->_field_obj)
            ->set('data', $this->data())
            ->render();
    }
}