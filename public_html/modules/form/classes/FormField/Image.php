<?php defined('SYSPATH') or die('No direct script access.');

class FormField_Image extends FormField
{
    public function rules()
    {
        $field_name = $this->_field_obj->name;
        return Validation::factory(array($field_name => $this->$field_name))
            ->rule($this->_field_obj->name, 'not_empty')
            ->rule($this->_field_obj->name, 'FormField_Images::valid_image');
    }

    public function __toString()
    {
        return View::factory('html/form_fields/image')
            ->set('field', $this->_field_obj)
            ->render();
    }

    public static function valid_image($images)
    {
        $valid_mime_types = array('image/png', 'image/jpg', 'image/gif', 'image/jpeg');

        foreach($images as $key=>$image)
        {
            if (!in_array($image['type'][$key], $valid_mime_types))
            {
                return false;
            }
            elseif ($image['error'][$key] != 0)
            {
                return false;
            }
            elseif ($image['size'][$key] > 6291456)
            {
                return false;
            }
        }

        return true;
    }
}