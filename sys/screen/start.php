<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

//echo 'Screen Start test';

$JCliX->out('JCliExtended v 0.2alpha');
$JCliX->out('https://github.com/fititnt/jcli');
//$JCliX->out('Last use                : (datetime here)');
//$JCliX->out('Automatic Alerts        : none');

$loadedFunctions = $JCliX->loadFunctions();
$loadedFunctionsMsg = 'Loaded functions:';
foreach($loadedFunctions AS $item){
    $loadedFunctionsMsg .= ' '.$item;
}

$JCliX->out($loadedFunctionsMsg);