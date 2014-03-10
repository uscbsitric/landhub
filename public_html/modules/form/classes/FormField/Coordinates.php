<?php defined('SYSPATH') or die('No direct script access.');

class FormField_Coordinates extends FormField
{
    public function rules()
    {
        return Validation::factory(array(
            'longitude' => $this->value['longitude'],
            'latitude'  => $this->value['latitude']))
            ->rule('longitude', 'not_empty')
            ->rule('longitude', 'decimal')
            ->rule('latitude', 'not_empty')
            ->rule('latitude', 'decimal');
    }

    public function assign($values)
    {
        $this->value['longitude'] = $values['gps']['longitude'];
        $this->value['latitude'] = $values['gps']['latitude'];
    }

    public function __toString()
    {
        return View::factory('html/form_fields/coordinates')
            ->set('field', $this->_field_obj)
            ->render();
    }
}