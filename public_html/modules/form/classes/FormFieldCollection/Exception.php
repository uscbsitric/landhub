<?php defined('SYSPATH') or die('No direct script access.');

class FormFieldCollection_Exception extends Kohana_Exception
{
    protected $_errors = array();

    public function __construct($message, $errors)
    {
        $this->_errors = $errors;
        parent::__construct($message);
    }

    public function errors($errors = null)
    {
        if(empty($errors))
        {
            return $this->_errors;
        }

        $this->_errors = $errors;
    }
}