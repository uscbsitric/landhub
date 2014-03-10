<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template
{
    public $template = 'templates/blank';

    public function action_login()
    {
        $errors = array();

        if ($this->request->method() == 'POST')
        {
            $username = $this->request->post('username');
            $password = $this->request->post('password');

            if (!Auth::instance()->login($username, $password))
            {
                $errors[] = __('The username or password you entered is incorrect');
            }
            else
            {
                $this->redirect('/');
                exit();
            }
        }

        $this->template->content = View::factory('html/auth/login')
            ->set('errors', $errors);

        $this->template->sub_content = View::factory('html/auth/login-bottom');
    }

    public function action_logout()
    {
        Auth::instance()->logout(true, true);
        $this->redirect('/login');
        exit();
    }

    public function action_register()
    {
        $errors = array();

        if ($this->request->method() == 'POST')
        {
            try
            {
                $user = Model_User::register($_POST);
                Auth::instance()->force_login($user->username);
                $this->redirect('/');
                exit();
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = $e->errors('model');
            }
        }

        $this->template->content = View::factory('html/auth/register')
            ->set('errors', $errors);
    }

    public function action_password_reset_request()
    {
        $this->template = View::factory('templates/quickstart/reset-password');

        if ($this->request->method() == 'POST')
        {
            Model_User::generate_reset_password_token($this->request->post('email'));

            $this->template->content = View::factory('html/reset-password/request-confirmation');
        }
        else
        {
            $this->template->content = View::factory('html/reset-password/request');
        }
    }

    public function action_password_reset_token()
    {
        $errors = array();

        $this->template = View::factory('templates/quickstart/reset-password');

        $user_id = $this->request->query('uid');
        $token = $this->request->query('token');

        $user = ORM::factory('User', array('id' => $user_id));

        if (!$user->loaded()) throw new HTTP_Exception_404('No such user');

        $expected_token = $user->get_reset_password_token();

        if ($expected_token === NULL || $token != $expected_token->token)
        {
            $this->template->content = View::factory('html/reset-password/invalid-token');
        }
        else
        {
            if ($this->request->method() == 'POST')
            {
                try
                {
                    $user->update_user($_POST, array('password'));
                    $expected_token->delete();

                    Session::instance()->set('_flash', 'Your password has been reset');

                    Auth::instance()->logout(true, true);
                    $this->redirect('/login');

                    exit();
                }
                catch(ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('model');
                }
            }

            $this->template->content = View::factory('html/reset-password/reset');
            $this->template->errors = $errors;
        }
    }
}