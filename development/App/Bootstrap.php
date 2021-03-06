<?php

namespace App;

class Bootstrap
{
	public static function Init () {
		// patch core to use extended request class for cli
		\MvcCore::GetInstance()->SetRequestClass(\MvcCore\Ext\Request\Cli::class);

		// patch core to use extended debug class
		\MvcCore::GetInstance()->SetDebugClass(\MvcCore\Ext\Debug\Tracy::class);
		
		// set up application routes without custom names, defined basicly as Controller::Action
		\MvcCore\Router::GetInstance(array(
			'Index:Index'			=> array(
				'pattern'			=> "#^/$#",
				'reverse'			=> '/',
			),
			'CdCollection:Index'	=> array(
				'pattern'			=> "#^/albums$#",
				'reverse'			=> '/albums',
			),
			'CdCollection:Create'	=> array(
				'pattern'			=> "#^/create#",
				'reverse'			=> '/create',
			),
			'CdCollection:Edit'	=> array(
				'pattern'			=> "#^/edit/([0-9]*)#",
				'reverse'			=> '/edit/{%id}',
				'params'			=> array('id' => 0,),
			),
		));
	}
}