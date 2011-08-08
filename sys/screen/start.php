<?php
/**
 * @package     JCli
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

class JClicExtendedScrenStart extends JClicExtended
{
    public function execute( )
        {        
        $this->out( 'Some initial info' );
        }
}
//JCli::getInstance( 'JClicExtendedScrenStart' )->execute();

//echo 'Screen Start test';