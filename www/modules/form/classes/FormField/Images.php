<?php defined('SYSPATH') or die('No direct script access.');

class FormField_Images extends FormField
{
    public function rules()
    {
        $field_name = $this->_field_obj->name;
        return Validation::factory(array($field_name => $this->$field_name))
            ->rule($this->_field_obj->name, array($this, 'valid_images'));
    }

    public function __toString()
    {
        return View::factory('html/form_fields/images')
            ->set('field', $this->_field_obj)
            ->render();
    }

    public function valid_images($images)
    {
        if ($this->is_required())
        {
            if (empty($images['name'][0])) return false;
        }

        $valid_mime_types = array('image/png', 'image/jpg', 'image/gif', 'image/jpeg');

        foreach($images as $key=>$image)
        {
            foreach($image as $node=>$img)
            {
                if (!in_array($images['type'][$node], $valid_mime_types))
                {
                    return false;
                }
                elseif ($images['error'][$node] != 0)
                {
                    return false;
                }
                elseif ($images['size'][$node] > 6291456)
                {
                    return false;
                }
            }
        }

        return true;
    }

    public function process()
    {
        $field_name = $this->_field_obj->name;
        $this->$field_name = $this->upload_images($this->images);
    }

    public function upload_images($images)
    {
        $list = array();

        for($i=0; $i < sizeof($images['name']); $i++)
        {
            $ext = preg_replace('/^.*\./', '', $images['name'][$i]);
            $tmp = $images['tmp_name'][$i];
            $hash = sha1(strtotime('now').$images['name'][$i]).'.'.$ext;

            move_uploaded_file($tmp, DOCROOT.'media/uploads/'.$hash);

            $list[] = $hash;
        }

        return $list;
    }
}