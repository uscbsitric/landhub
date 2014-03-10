<?php defined('SYSPATH') or die('No direct script access.');

abstract class DataSourceField extends FormField
{
    protected $_data = null;

    public function in_data($value)
    {
        $data = $this->data();

        if(in_array($value, array_keys($data))) return true;
        return false;
    }

    public function data()
    {
        if (!empty($this->_data)) return $this->_data;

        $data = DataSourceFactory::factory(ucfirst($this->_field_obj->data_source));
        $this->_data = $data->data();
        return $this->_data;
    }
}