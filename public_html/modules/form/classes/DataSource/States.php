<?php defined('SYSPATH') or die('No direct script access.');

class DataSource_States extends DataSource
{
    public function data()
    {
        $sql = "select * from states";
        $results = DB::query(Database::SELECT, $sql)->execute();
        $list = array();

        foreach($results as $result)
        {
            $list[$result['abbreviation']] = $result['name'];
        }

        return $list;
    }
}