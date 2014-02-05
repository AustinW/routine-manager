<?php

return array(

	'default' => 'mysql',

	'log'     => true,

	'connections' => array(

		'mongodb' => array(
			'driver'   => 'mongodb',
			'host'     => 'localhost',
			'port'     => 27017,
			'username' => '',
			'password' => '',
			'database' => 'routine_manager'
		),
	)
);