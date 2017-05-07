<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package multifileupload
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$arrDca = &$GLOBALS['TL_DCA']['tl_settings'];

/**
 * Palettes
 */
$arrDca['palettes']['__selector__'][] = 'activateDbCache';
$arrDca['palettes']['default'] .= ';{db_cache_legend},activateDbCache;';

/**
 * Subpalettes
 */
$arrDca['subpalettes']['activateDbCache'] = 'dbCacheMaxTime';

/**
 * Fields
 */
$arrFields = [
    'activateDbCache' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['activateDbCache'],
        'exclude'   => true,
        'inputType' => 'checkbox',
        'eval'      => ['tl_class' => 'w50', 'submitOnChange' => true]
    ],
    'dbCacheMaxTime'  => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dbCacheMaxTime'],
        'exclude'   => true,
        'inputType' => 'timePeriod',
        'options'   => ['m', 'h', 'd'],
        'reference' => &$GLOBALS['TL_LANG']['MSC']['timePeriod'],
        'eval'      => ['mandatory' => true, 'tl_class' => 'w50']
    ]
];

if (!\Config::get('dbCacheMaxTime'))
{
    \Config::set('dbCacheMaxTime', serialize(\StraightSoft\DatabaseCache\DatabaseCache::DEFAULT_MAX_CACHE_TIME));
    \Config::persist('dbCacheMaxTime', serialize(\StraightSoft\DatabaseCache\DatabaseCache::DEFAULT_MAX_CACHE_TIME));
}

$arrDca['fields'] = array_merge($arrFields, $arrDca['fields']);