<?php
/**
 * @package     JCli
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

if($config['DEBUG'] == 1) {
    var_dump($config);
}

if (!file_exists($config['JOOMLA_FRAMEWORK_PATH'])){
    echo 'The Joomla Framework Path "' . $config['JOOMLA_FRAMEWORK_PATH'] . '" does not exist. Please revise add a valid value at config.ini';
    exit();    
}

//Load Joomla Application Cli
include_once( $config['JOOMLA_FRAMEWORK_PATH']  );
jimport( 'joomla.application.cli' );

//Load JCli Library
include_once('library.php');

//
$JCliX->screenLoad( $JCliX, 'start');
$JCliX->screenLoad( $JCliX, 'core');
$JCliX->screenLoad( $JCliX, 'end');

