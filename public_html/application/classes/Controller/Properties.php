<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Properties extends Lsp_Controller_Template
{
    public $template = 'templates/default';

    public function action_index()
    {
        $list = ORM::factory('Property')
            ->where('user_id', '=', $this->_user->id)
            ->find_all();

        $this->template->content = View::factory('html/properties/list')
            ->set('list', $list);
    }

    public function action_new()
    {
        $errors = array();

        $property_types = ORM::factory('Property_Type')
            ->where('is_archived', '=', 0)
            ->find_all();

        if ($this->request->method() == 'POST')
        {
            try
            {
                DB::query(null, 'start transaction')->execute();

                $property = ORM::factory('Property')->values($_POST, array(
                    'property_type_id',
                    'title',
                    'description',
                    'price',
                    'acres',
                    'company_name',
                    'contact_name',
                    'contact_email',
                    'contact_phone',
                    'mls_id',
                    'mls_url',
                    'school_district',
                    'subdivision',
                    'address',
                    'zip_code',
                    'beds',
                    'baths',
                    'sqft',
                    'levels',
                    'has_garage',
                    'notes',
                    'date_created',
                ));

                if (sizeof($_FILES))
                {
                    $property->validate_photos($_FILES['photos']);
                }

                $property->user_id = $this->_user->id;
                $property->slug = URL::title($property->title);
                $property->date_created = DB::expr('now()');
                $property->last_updated = DB::expr('now()');
                $property->save();

                if (sizeof($_FILES))
                {
                    $property->add_photos($_FILES['photos']);
                }

                DB::query(null, 'commit')->execute();

                $this->redirect('/properties');
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors('model');
            }
            catch(Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = array('exception' => $e->getMessage());
            }
        }

        $this->template->content = View::factory('html/properties/new')
            ->set('property_types', $property_types)
            ->set('errors', $errors);
    }

    public function action_edit()
    {
        $errors = array();

        $property_types = ORM::factory('Property_Type')
            ->where('is_archived', '=', 0)
            ->find_all();

        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        if (!$item->loaded()) throw new HTTP_Exception_404('No such property');

        if ($this->request->method() == 'POST')
        {
            try
            {
                DB::query(null, 'start transaction')->execute();

                $item->values($_POST, array(
                    'property_type_id',
                    'title',
                    'description',
                    'price',
                    'acres',
                    'company_name',
                    'contact_name',
                    'contact_email',
                    'contact_phone',
                    'mls_id',
                    'mls_url',
                    'school_district',
                    'subdivision',
                    'address',
                    'zip_code',
                    'beds',
                    'baths',
                    'sqft',
                    'levels',
                    'has_garage',
                    'notes',
                    'last_updated',
                    'is_archived',
                ));

                if (sizeof($_FILES))
                {
                    $item->validate_photos($_FILES['photos']);
                }

                $item->slug = URL::title($item->title);
                $item->last_updated = DB::expr('now()');
                $item->update();

                if (sizeof($_FILES))
                {
                    $item->add_photos($_FILES['photos']);
                }

                DB::query(null, 'commit')->execute();

                $this->redirect('/properties');
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors('model');
            }
            catch(FormFieldCollection_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors();
            }
        }

        foreach($item->as_array() as $key=>$val)
        {
            $_POST[$key] = $val;
        }

        $photos = $item->photos->where('is_archived', '=', 0)->find_all();

        $this->template->content = View::factory('html/properties/edit')
            ->set('id', $id)
            ->set('remaining', $item->num_photos_remaining())
            ->set('property_types', $property_types)
            ->set('photos', $photos)
            ->set('errors', $errors);
    }

    public function action_archive()
    {
        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        $item->is_archived = 1;
        $item->update();

        $this->redirect('/properties');
        exit();
    }

    public function action_activate()
    {
        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        $item->is_archived = 0;
        $item->update();

        $this->redirect('/properties');
        exit();
    }
}