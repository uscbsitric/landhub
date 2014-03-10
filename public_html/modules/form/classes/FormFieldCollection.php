<?php defined('SYSPATH') or die('No direct script access.');

class FormFieldCollection
{
    protected $_fields;

    protected $_errors;

    public function __construct($list)
    {
        $this->_fields = $list;
    }

    public function fields()
    {
        return $this->_fields;
    }

    public function values($values = null)
    {
        if( !empty($values))
        {
            foreach($this->_fields as $field)
            {
                $field->assign($values);
            }
        }
        else {
            return $this->_fields;
        }
    }

    public function validate()
    {
        $this->_errors = array();

        foreach($this->_fields as $field)
        {
            if (!$field->validate())
            {
                $errors = $field->errors();
                $this->_errors = array_merge($this->_errors, $errors);
            }
        }

        if (sizeof($this->_errors))
        {
            throw new FormFieldCollection_Exception('Failed to validate collection', $this->_errors);
        }
    }

    public function upsert($mongo_id, $id)
    {
        $values = $this->values();

        $data = array();
        $data['id'] = $id;
        $fields = array();

        foreach($values as $val)
        {
            $val->process();

            $field = array();
            $field['key'] = $val->name;
            $field['value'] = $val->field_value();
            $field['vertical_field_id'] = $val->id;
            $fields[] = $field;
        }

        $data['fields'] = $fields;

        $mongodb = new MongoClient();

        $db = $mongodb->lsp;

        $elements = $db->elements;

        $criteria['_id'] = $mongo_id;

        $options['upsert'] = true;

        $obj['$set'] = $data;

        $mongo_id = $elements->update(
            $criteria,
            $obj,
            $options
        );

        return $mongo_id;
    }
}