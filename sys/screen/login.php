<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();


$user = array('username' => 'root', 'password' => NULL, 'sshkey' => NULL);

$JCliX->out('Username:', FALSE );
$JCliX->setVar( 'username', $JCliX->in_s() );

$JCliX->out('Password:', FALSE );
$JCliX->setVar( 'password', $JCliX->in_s() );

$JCliX->out('SSHKeyPath:', FALSE );
$JCliX->setVar( 'sshkey', $JCliX->in_s() );
