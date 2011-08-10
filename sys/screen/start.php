<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

if( $JCliX->startupCheck() !== TRUE ){
    echo "Error: ";
    print_r($JCliX->startupCheck());
    die("Error");
}

$JCliX->out('JCliExtended v 0.3alpha');
//$JCliX->out('https://github.com/fititnt/jcli');
