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
    $this->out( $this->getCliPrefix(), FALSE );
    //Take user input  
    $input = $this->in_s();//$JCliX->in();
    //Run
    $this->doIt( $input );
    
    
} while ( strpos( $input ,'exit') === FALSE );
