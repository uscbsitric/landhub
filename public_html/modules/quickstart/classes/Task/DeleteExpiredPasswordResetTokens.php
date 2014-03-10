<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Help task to display general instructons and list all tasks
 *
 * @package    Kohana
 * @category   Helpers
 * @author     Kohana Team
 * @copyright  (c) 2009-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Task_DeleteExpiredPasswordResetTokens extends Minion_Task
{
    /**
     * Generates a help list for all tasks
     *
     * @return null
     */
    protected function _execute(array $params)
    {
        DB::delete('user_pw_reset_tokens')
            ->where('expires', '<', DB::expr('now()'))
            ->execute();
    }
}