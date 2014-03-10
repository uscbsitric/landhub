<?php defined('SYSPATH') or die('No direct script access.');

class Model_Quickstart_User extends Model_Auth_User
{
    /**
     * A user has many tokens and roles
     *
     * @var array Relationhips
     */
    protected $_has_many = array(
        'user_tokens'       => array('model' => 'User_Token'),
        'roles'             => array('model' => 'Role', 'through' => 'roles_users'),
        'password_tokens'   => array('model' => 'Quickstart_Password_Token'),   // for password resets
    );

    public function rules()
    {
        return array(
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

    public function unique_key($value)
    {
        return 'username';
    }

    public static function register($values)
    {
        $user = ORM::factory('User')->create_user($values, array(
            'username',
            'email',
            'password',
        ));

        $user->add('roles', ORM::factory('Role', array('login')));
        return $user;
    }

    public static function generate_reset_password_token($email)
    {
        $user = ORM::factory('User', array('email' => $email));
        $role = ORM::factory('Role', array('name' => 'login'));

        if ($user->loaded() && $user->has('roles', $role))
        {
            $token = $user->get_reset_password_token();

            if ($token === NULL)
            {
                $token = ORM::factory('Quickstart_Password_Token');
                $token->user_id = $user->id;
                $token->token = sha1(Cookie::$salt.uniqid());
                $token->date_created = DB::expr('now()');
                $token->expires = DB::expr('date_add(curdate(), interval 1 day)');
                $token->save();
            }

            // send email

            $email_body = View::factory('html/emails/reset-password')
                ->set('uid', $user->id)
                ->set('token', $token->token);

            mail($user->email, 'Password Reset Request', $email_body);

            return $token;
        }

        return NULL;
    }

    public function get_reset_password_token()
    {
        $token = ORM::factory('Quickstart_Password_Token')
            ->where('user_id', '=', $this->id)
            ->where('expires', '>', DB::expr('now()'))
            ->find();

        if ($token->loaded()) return $token;
        return NULL;
    }
}