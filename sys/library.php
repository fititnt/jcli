<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();

class JCliExtended extends JCli
{
     /**
     * CLI var
     * 
     * @since  0.2
     */
    public $cliPrefix = array('project' => NULL, 'extension' => NULL, 'librares' => array('jcli') );
    
    /**
     * Core functions of JCliExtended
     * 
     * @since  0.2
     */
    public $coreFunctions = array('jcli');
    
    /**
     * Array of files of custon functions.
     *
     * @since   0.2
     */
    public $loadedFunctions = array();
    

    /**
     * Array of files of custon functions.
     *
     * @since   0.2
     */
    public $loadedFunctionsFiles = array();
    
    
    /**
     * Get input from CLI, in a safe way. Joomla Platforms JCli::in bug on Win
     *
     * @param   string      $input: input of user
     *
     * @since   0.2
     */
    public function in_s(){      
        
        /* Here be dragons */
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {            
            $input = substr( rtrim(fread(STDIN, 8192), "\n") , 0, -1); //$input = rtrim(fread(STDIN, 8192), "\n");
        } else {
            $input = $this->in($input);
        }        
        
        /*
        $length = strlen( $input ); 
        $lastchar = substr( $input , -2);        
        if( ctype_cntrl($lastchar) ){
            $input = substr( $input ,0,-2);
            echo ' Have Control chars';
        } else {
            echo ' Do not have control chars';
        }
        */
        //echo $input;
        //fread(STDIN, 8192);
        //die();
        return $input;
    }
    
    /**
     * Get CLI prefix
     *
     * @return   string      $input: input of user
     *
     * @since   0.2
     */
    public function getCliPrefix(){
        $result = '';
        if( $this->cliPrefix['project'] != NULL ){
            $result .= $this->cliPrefix['project'] . ':';
        }
        $i = 0;
        foreach( $this->cliPrefix['librares'] AS $library){
            $result .= $library;
            if($i>0){
              $result = ':'.$result;
            }
        }
        if( $this->cliPrefix['extension'] != NULL ){
            $result .= '->' . $this->cliPrefix['extension'];
        }
        $result .= '>';
        return $result;        
    }
    
   
    /**
     * Get imput from user, parse it, and call functions, if is need
     *
     * Returns the global {@link JApplication} object, only creating it if it doesn't already exist.
     *
     * @param   string      $imput: input of user
     *
     * @return  Respective command or message of error
     *
     * @since   0.2
     */
    public function doIt( $imput ){        
        
        $parsedInput = $this->_parseInput( $imput , array( 'arg', 'getopt' ) );
        
        //Fist check if is one core function
        if ( in_array( strtolower($parsedImput['command']) ,  $this->coreFunctions) ){
            //...
            return true;
        } else if ( in_array( strtolower( $parsedImput['command'] ), $this->loadedFunctions ) ){
            //...
            return true;
        } else {            
            return false; //Error
        }
           
    }

    
    
     /**
     * Get imput from user and parse, and retun respnse like arg($argc & $argv) and getopt() function
     *
     * Returns the global {@link JApplication} object, only creating it if it doesn't already exist.
     *
     * @param   string     $imput: input of user
     * 
     * @param   array      $mode: options of mode (args, getopt)
     *
     * @return  parsed input, or false if get some error
     *
     * @since   0.2
     */    
    private function _parseInput($input, $mode = NULL){
        
        $parsedImput = array();
        if ( in_array('args', $mode) ){
            $parsedImput['args'];
            $parsedImput['command'];
            //...
        }
        if ( in_array('getopt', $mode) ){
            $parsedImput['getopt'];
            $parsedImput['command'];
            //...
        }
        if ( $mode == NULL){
            $parsedImput['command'];
            //...
        }
        
        if( isset($parsedImput['command'] )){
            return $parsedImput;
        } else {
            return false; //Error
        }
    }
    
    
    
    
     /**
     * Include file of one especific screen name
     * 
     * @param             string          $screenName: name of screen to load
     *
     * @return  bool       TRUE if file load is fine, FALSE if is not
     *
     * @since   0.2
     */    
    public function screenLoad( $JCliX, $screenName ){        
            $path = _JCLI . '/sys/screen/' . $screenName . '.php';
            if( is_file($path) ){
                include_once( _JCLI . '/sys/screen/'.$screenName.'.php' );
                return true;
            } else {
                return false;
            }            
        }
    
      
     /**
     * Clear CLI Screen
     *
     * @todo: make it ***REALLY*** works on multiple plataforms
     *
     * @return  bool       TRUE if file load is fine, FALSE if is not
     * 
     * @since   0.2
     */
    public function screenClear(){
        for ($i=0;$i<30;$i++){
            echo "\n";
        }
        return TRUE;
    }
     
    
     /**
     * Returns array with names of loaded functions
     *
     * @return  void
     *
     * @since   0.2
     */
    public function loadFunctions()
        {
        jimport('joomla.filesystem.folder');
        $this->loadedFunctionsFiles = JFolder::files( _JCLI .'/functions', 'php');
        
        
        foreach( $this->loadedFunctionsFiles AS $item ){
            $this->loadedFunctions[] = str_replace('.php', '', strtolower($item));
        }
        
        return $this->loadedFunctions;
        }
        
        
    /**
     * Wrinte one array or object on screen
     *
     * @param   mixed  $array    The array to output.
     *
     * @return  void
     *
     * @since   0.2
     */
    public function outf( $array ){

        //Se for unidimensional...
        if ( is_array($array) ){
            foreach($array AS $item){
                $this->out( $item );
            }
            return true;
        } else if ( is_object($array) ) {

            return true;
        } else {
            return false;
        }
        //Se for multidimencional
    }
        
	
    /**
     * outt: Write on CLI one object or arrat of itens
     *
     * @param   mixed  $object    The $item to insert
     *
     * @return  void
     *
     * @since   
     */
    public function outt( $object ){

        //Se for unidimensional...
        if ( is_array($array) ){
            foreach($array AS $item){
                $this->out( $item );
            }
            return true;
        } else if ( 1 ) {
            //...
            return true;
        } else {
            //...
            return false;
        }
        //Se for multidimencional            
    }
    
     /**
     * Get imput from user and parse, and retun respnse like arg($argc & $argv) and getopt() function
     *
     * Returns the global {@link JApplication} object, only creating it if it doesn't already exist.
     *
     * @param   string     $imput: input of user
     * 
     * @param   array      $mode: options of mode (args, getopt)
     *
     * @return  parsed input, or false if get some error
     *
     * @since   0.2
     */    
    private function _parseIable($imput, $mode = NULL){

        $parsedImput = array();
        if ( in_array('args', $imput) ){
            $parsedImput['args'];
            $parsedImput['command'];
            //...
        }
        if ( in_array('getopt', $imput) ){
            $parsedImput['getopt'];
            $parsedImput['command'];
            //...
        }
        if ( $mode == NULL){
            $parsedImput['command'];
            //...
        }
        
        if( isset($parsedImput['command'] )){
            return $parsedImput;
        } else {
            return false; //Error
        }
    }
}
$JCliX = JCli::getInstance( 'JCliExtended' );


