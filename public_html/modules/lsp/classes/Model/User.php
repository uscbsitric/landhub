<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model_Quickstart_User
{

    protected $_has_many = array(
        'user_tokens'       => array('model' => 'User_Token'),
        'roles'             => array('model' => 'Role', 'through' => 'roles_users'),
        'password_tokens'   => array('model' => 'Quickstart_Password_Token'),   // for password resets
        'properties'        => array('model' => 'Property', 'foreign_key' => 'user_id'),
    );

    public function rules()
    {
        return array(
            'first_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 32)),
            ),
            'last_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 32)),
            ),
            'username' => array(
                array('not_empty'),
                array('min_length', array(':value', 1)),
                array('max_length', array(':value', 32)),
                array(array($this, 'unique'), array('username', ':value')),
            ),
            'password' => array(
                array('not_empty'),
            ),
            'email' => array(
                array('not_empty'),
                array('email'),
                array(array($this, 'unique'), array('email', ':value')),
            ),
        );
    }

    public static function register($values)
    {
        try
        {
            DB::query(null, 'start transaction')->execute();

            $user = ORM::factory('User')->create_user($values, array(
                'username',
                'email',
                'first_name',
                'last_name',
                'password',
            ));

            $user->add('roles', ORM::factory('Role', array('login')));

            DB::query(null, 'commit')->execute();
        }
        catch(Exception $e)
        {
            DB::query(null, 'rollback')->execute();
            throw $e;
        }

        return $user;
    }
}