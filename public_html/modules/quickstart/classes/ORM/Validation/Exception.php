<?php defined('SYSPATH') or die('No direct script access.');

class ORM_Validation_Exception extends Kohana_ORM_Validation_Exception
{
    public function errors($directory = NULL, $translate = TRUE)
    {
        $errors = $this->generate_errors($this->_alias, $this->_objects, $directory, $translate);

        return Helper_Messages::convert_messages_from_model($errors);
    }
}