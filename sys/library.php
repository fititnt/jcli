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
      * User login var
      * 
      * @since  0.2
      * 
      * @todo: remove it later. For sure will not need like this way
     */
    public $user = array('username' => 'root', 'password' => NULL, 'sshkey' => NULL);
    
    /**
     * Libraries object
     * 
     * @since  0.2
     */
    public $libraries;
    

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
     * Set Var
     *
     * @return   bool      TRUE if has var to set, FALSE if not
     * 
     * @todo:   Make a check for be sure that vars are of the same type to avoid errors
     *
     * @since   0.2
     */
    public function setVar( $name, $value){
        if( isset($this->$name) ){
            $this->$name = $value;
            return TRUE;
        } else {
            return FALSE;
        }      
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
    public function doIt( $input ){        
        
        $parsedInput = $this->_parseArgs( $input ) ;
        
        print_r( $parsedInput ); //die();
        /*
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
         */
           
    }

    /**
     * startupCheck
     * Make a few routines before load the JCliX
     *
     * @return   mixed      TRUE if ok, and String or Array.  (Think better later)
     *
     * @since   0.2
     */
    public function startupCheck(){
        
        $this->libraries = new stdClass();
        $libraries = $this->_librariesLoad( _JCLI . '/sys/lib/' );
        $this->libraries->core = $libraries;
        $libraries = $this->_librariesLoad( _JCLI . '/lib/' );
        $this->libraries->ext = $libraries;
        
        //print_r($this->libraries);

        //@todo...
        return TRUE;    
    }
    /*
     * 
     */
    private function _librariesLoad($path){
        jimport('joomla.filesystem.folder');
        $libraries = new stdClass();
        $folders = JFolder::folders( $path );
        
        foreach($folders AS $folder){
            if( true ){ //Some better check is is really a librarie
                $libraries->$folder = TRUE;
                //@todo: load functions inside the library
            }
        }
        return $libraries;
    }
    
    
    /**
     * startupLogin
     * Check for one user and password, if are rigth, load respective data from
     * user directory
     *
     * @return   mixed      TRUE if ok, and String or Array.  (Think better later)
     *
     * @since   0.2
     */
    public function startupLogin( $JCliX ){
        
        $user = $this->screenLoad( $JCliX, 'login');
        if ( $this->user['sshkey'] == NULL || strlen($this->user['sshkey']) < 4 ){            
            $replateUser = $this->user;
            $replateUser['sshkey'] = _JCLI . '/user/'. $user['username'] . '/.ssh/id_rsa';            
            $this->setVar( 'user', $replateUser );
        }
        $JCliX->out( 'Startup login test. Dump...');
        $JCliX->out( 'Username: ' . $this->user['username'] . ' | Password:' . $this->user['password'] . ' | SSH Key Path: ' . $this->user['sshkey'] );
        $JCliX->out( 'Login "ok"'. "\n\n");  
        //@todo...
        return TRUE;    
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
     * 
     * @deprecated
     *  
     */    
    private function _parseInput($input, $mode = NULL){
        
        $args = array();
        /*
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
        */
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
     * 
     * @deprecated
     */
    public function loadFunctions() {
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
    
    /*
     * Command Line Interface (CLI) utility class.
     * http://pwfisher.com/nucleus/index.php?itemid=45
     * 
     * @author              Patrick Fisher <patrick@pwfisher.com>
     * 
     * @since               0.3
     */
    private function _parseArgs( $input ){

        $out = array();
        $argv = array();
        
        $imputArray = explode(" ", $input );
        
        $lib = array_shift( $imputArray );
        
        $argv = $imputArray;
        
        foreach ($argv as $arg){

            // --foo --bar=baz
            if (substr($arg,0,2) == '--'){
                $eqPos                  = strpos($arg,'=');

                // --foo
                if ($eqPos === false){
                    $key                = substr($arg,2);
                    $value              = isset($out[$key]) ? $out[$key] : true;
                    $out[$key]          = $value;
                }
                // --bar=baz
                else {
                    $key                = substr($arg,2,$eqPos-2);
                    $value              = substr($arg,$eqPos+1);
                    $out[$key]          = $value;
                }
            }
            // -k=value -abc
            else if (substr($arg,0,1) == '-'){

                // -k=value
                if (substr($arg,2,1) == '='){
                    $key                = substr($arg,1,1);
                    $value              = substr($arg,3);
                    $out[$key]          = $value;
                }
                // -abc
                else {
                    $chars              = str_split(substr($arg,1));
                    foreach ($chars as $char){
                        $key            = $char;
                        $value          = isset($out[$key]) ? $out[$key] : true;
                        $out[$key]      = $value;
                    }
                }
            }
            // plain-arg
            else {
                $value                  = $arg;
                $out[]                  = $value;
            }
        }
        $out = array_unshift($out, $lib);
        //var_dump($out);
        return $out;
    }
    
    /*
     * Get Boolean
     * 
     * @see                 http://pwfisher.com/nucleus/index.php?itemid=45
     * 
     * @author              Patrick Fisher <patrick@pwfisher.com>
     * 
     * @since               0.3
     */
    private function _getBoolean( $value , $default = false){
        if (!isset( $value )){
            return $default;
        }
        
        if (is_bool($value)){
            return $value;
        }
        if (is_int($value)){
            return (bool)$value;
        }
        if (is_string($value)){
            $value                      = strtolower($value);
            $map = array(
                'y'                     => true,
                'n'                     => false,
                'yes'                   => true,
                'no'                    => false,
                'true'                  => true,
                'false'                 => false,
                '1'                     => true,
                '0'                     => false,
                'on'                    => true,
                'off'                   => false,
            );
            if (isset($map[$value])){
                return $map[$value];
            }
        }
        return $default;
    }
    
    
}
$JCliX = JCli::getInstance( 'JCliExtended' );


