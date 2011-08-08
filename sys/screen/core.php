<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

do {
    //echo "\njcli>";
    $JCliX->out( $JCliX->getCliPrefix(), FALSE );
    
    
    $input = $JCliX->in_s();//$JCliX->in();
    
} while ( strpos($input,'exit') === FALSE );