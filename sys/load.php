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

//$JCliX->screenLoad('start');
$JCliX->out('JCliExtended v 0.2');
$JCliX->out('https://github.com/fititnt/jcli');
$JCliX->out('Last use                : (datetime here)');
$JCliX->out('Automatic Alerts        : none');

$loadedFunctions = $JCliX->loadFunctions();

$JCliX->out();
$loadedFunctionsMsg = 'Loaded functions:';
foreach($loadedFunctions AS $item){
    $loadedFunctionsMsg .= ' '.$item;
}
$JCliX->out($loadedFunctionsMsg);

$etc = fread(STDIN, 8192);//$etc = $JCliX->in();

var_dump($etc);

$etc = $JCliX->in();

var_dump($etc);

$meuarray = array("teste", "abc");


if (in_array($etc, $loadedFunctions)){
    echo 'esta no array';
}
//$JCliX->screenClear();

//$JCliX->screenLoad('core');

$i = 0;
do {
    echo "\njcli>";
    $imput = $JCliX->in();
    $JCliX->doIt( $imput );    
    var_dump($imput);
    $i++;
} while ( strpos($imput,'exit') === FALSE );


//$JCliX->screenLoad('end');




