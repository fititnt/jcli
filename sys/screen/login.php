<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();


$user = array('username' => 'root', 'password' => NULL, 'sshkey' => NULL);

$this->out('Username:', FALSE );
$this->setVar( 'username', $this->in_s() );

$this->out('Password:', FALSE );
$this->setVar( 'password', $this->in_s() );

$this->out('SSHKeyPath:', FALSE );
$this->setVar( 'sshkey', $this->in_s() );
