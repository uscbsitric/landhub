<?php defined('SYSPATH') or die('No direct script access.');

abstract class FormField
{
    public $value;

    protected $_errors;

    protected $_field_obj;

    public function __construct($field_obj)
    {
        $this->_field_obj = $field_obj;
    }

    public function __get($name) {

        if (!property_exists($this, $name))
            return $this->_field_obj->$name;

        return $this->$name;
    }

    public function errors($messages = null)
    {
        if (empty($messages)) return $this->_errors;

        $this->_errors = $messages;
    }

    public function validate()
    {
        $validate = $this->rules();

        if (!$validate->check())
        {
            $this->errors($validate->errors('Formfields/'.ucfirst($this->_field_obj->name)));
            return false;
        }

        return true;
    }

    public function is_required()
    {
        return (bool)$this->_field_obj->is_required;
    }

    public function is_hidden()
    {
        return ($this->_field_obj->is_visible == 1) ? false : true;
    }

    public function field_value()
    {
        $field_name = $this->_field_obj->name;
        return $this->$field_name;
    }

    public function assign($values)
    {
        $field_name = $this->_field_obj->name;
        $this->$field_name = (isset($values[$field_name])) ? $values[$field_name] : null;
    }

    public function process()
    {
    }

    abstract public function rules();

    abstract public function __toString();
}