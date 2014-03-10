<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Messages
{
    // flattens the errors message from a multi-dimensional array into a single collection of messages
    public static function convert_messages_from_model($errors, $messages = array())
    {
        foreach ($errors as $key=>$val)
        {
            if (!is_array($val))
            {
                $messages[$key] = $val;
            }
            else
            {
                $messages = array_merge($messages, Helper_Messages::convert_messages_from_model($val, $messages));
            }
        }
        return $messages;
    }
}