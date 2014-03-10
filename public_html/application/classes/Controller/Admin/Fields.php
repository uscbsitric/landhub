<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Fields extends Lsp_Controller_Admin_Template
{
    public $template = 'templates/default';

    public function action_index()
    {
        $list = $this->_vertical->fields->find_all();

        $this->template->content = View::factory('html/admin/fields/list')
            ->set('list', $list);
    }

    public function action_new()
    {
        $errors = array();

        if ($this->request->method() == 'POST')
        {
            try
            {
                $item = ORM::factory('Vertical_Field')->values($this->request->post());
                $item->vertical_id = $this->_vertical->id;
                $item->save();

                $this->redirect('/admin/fields');
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                $errors = $e->errors('model');
            }
        }

        $this->template->content = View::factory('html/admin/fields/edit')
            ->set('errors', $errors);
    }

    public function action_edit()
    {
        $errors = array();

        $id = $this->request->param('id');

        $item = ORM::factory('Vertical_Field')
            ->where('id', '=', $id)
            ->find();

        if (!$item->loaded()) throw new HTTP_Exception_404('No such custom field');

        if ($this->request->method() == 'POST')
        {
            try
            {
                $item->values($_POST);
                $item->update();

                $this->redirect('/admin/fields');
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                $errors = $e->errors('model');
            }
        }

        $_POST = $item->as_array();

        $this->template->content = View::factory('html/admin/fields/edit')
            ->set('errors', $errors);
    }

    public function action_delete()
    {
        $id = $this->request->param('id');

        $item = ORM::factory('Vertical_Field')
            ->where('id', '=', $id)
            ->find();

        $item->delete();

        $this->redirect('/admin/fields');
        exit();
    }
}
