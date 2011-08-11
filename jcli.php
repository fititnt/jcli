<?php
/**
 * @package     JCli
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
define( '_JEXEC', 1 );
define( '_JCLI', dirname(__FILE__) );

//Load Configuration
$config = parse_ini_file('config.ini');
//Load JCli system.
include_once( _JCLI . '/sys/load.php');

