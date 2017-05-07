<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'StraightSoft',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'StraightSoft\DatabaseCache\DatabaseCache' => 'system/modules/database_cache/classes/DatabaseCache.php',
));
