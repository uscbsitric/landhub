<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	Kohana::DEVELOPMENT => array
	(
		'type'       => 'MySQL',
		'connection' => array(
			'hostname'   => 'localhost',
			'database'   => 'data_synd_platform',
			'username'   => 'lhstage',
			'password'   => 'landhub$55',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
    Kohana::STAGING => array
    (
        'type'       => 'MySQL',
        'connection' => array(
            'hostname'   => 'localhost',
            'database'   => 'data_synd_platform',
            'username'   => 'lhstage',
            'password'   => 'landhub$55',
            'persistent' => FALSE,
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => FALSE,
    ),
    Kohana::PRODUCTION => array
    (
        'type'       => 'MySQL',
        'connection' => array(
            'hostname'   => 'localhost',
            'database'   => 'data_synd_platform',
            'username'   => 'lhstage',
            'password'   => 'landhub$55',
            'persistent' => FALSE,
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => FALSE,
    ),
);
