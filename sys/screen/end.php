<?php
/**
 * @package     JCli
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */

class JCliStartScreen extends JCli
{
    public function execute( )
        {        
        $this->out( 'Some initial info' );
        }
}
JCli::getInstance( 'JCliStartScreen' )->execute();