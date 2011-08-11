<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

//ver possivel erro aqui
do {
    //Print Screen
    $JCliX->out( $JCliX->getCliPrefix(), FALSE );
    //Take user input  
    $input = $JCliX->in_s();//$JCliX->in();
    //Run
    $JCliX->doIt( $input );
    
    
} while ( strpos( $input ,'exit') === FALSE );
