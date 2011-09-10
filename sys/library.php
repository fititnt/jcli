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
       * 
       * @deprecated
      */
    public $cliPrefix = array('project' => NULL, 'extension' => NULL, 'librares' => array('jcli') );
    
    /*
     * CLI var
     * 
     * @since 0.3
     */
    public $cli;
    
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
     * Last command
     * 
     * @since  0.2
     */
    public $command;
    

    /**
     * Array of files of custon functions.
     *
     * @since   0.2
     */
    public $loadedFunctionsFiles = array();
    
    
    
    function __construct($nome, $idade)
    {
        $this->cli = array('project' => NULL, 'cmd' => array('jcli') );
        
        $this->libraries = new stdClass();
        $libraries = $this->_librariesLoad( JCLI_CORELIB_PATH );
        $this->libraries->core = $libraries;
        $libraries = $this->_librariesLoad( JCLI_3RDLIB_PATH );
        $this->libraries->third = $libraries;
        $libraries = $this->_librariesLoad( JCLI_UNIX_PATH );
        $this->libraries->unix = $libraries;
        $libraries = $this->_librariesLoad( JCLI_WIN_PATH );
        $this->libraries->unix = $libraries;
    }
    
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
     * Trying to reach a better way to output vars than JCli out
     *
     * @param   mixed      $output: input of user
     * 
     * @param   mixed      $param: false simple output, true `more advanced` output
     *
     * @since   0.3
     */
    public function out_s( $output , $param = FALSE){ //
        
        if(is_a( $output )){//Check if is object
              
            print_r($output); // Think in make it better later
            //Unidimensional
            /*
            foreach($array AS $item){
                $this->out( $item );
                echo "is_a foreach";
            }
             */
            //@todo: make it work for multidimensional arrays
            
        } else if( is_array($output) ){//Check if is array
            //Unidimensional
            foreach($array AS $item){
                $this->out( $item );
                echo "is_array foreach";
            }
            //@todo: make it work for multidimensional arrays
        } else if(is_bool( $output )){//Check if is array
            if($param === TRUE){
                if($output){
                    $this->out( 'TRUE' );
                } else {
                    $this->out( 'FALSE' );
                }
            } else {
                $this->out( $output );
            }
        } else if(is_string( $output )) {
            $this->out( $output );
        } else {            
            var_dump( $output); //If REALLY does not know what is
        }       
        
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
        $n = count( $this->cli['cmd'] );
        for($i=0; $i < $n; $i++){
            if($i > 0){
                $result .= '->';
            }
            $result .= $this->cli['cmd'][$i];
        }
        /*
        
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
         * 
         * 
         */
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
        
        $this->_parseArgs( $input ) ;
        
        $taskOne = $this->command->task[0];
        
        if($taskOne) { //If have at least one task
            var_dump($this->libraries);
        }
        
        
        
        
        /*
        switch ( (string)$taskOne ) {
            case 'jcli':
                    $this->JCLI();
                break;
            case 'exit':
                    $this->JCLI();
                break;
            default:
                break;
        }
         */
    }

    /*
     * JCLI Core
     * JCli task will aways need one adicional param that will do somethink
     * 
     * @var         string      $command: command to excecute
     *  
     * @return      bool        TRUE if no errors
     * 
     * @since       0.3
     */
    public function JCLI( $command = NULL ) {
        
        //If is unset, load from $this->command
        if($command === NULL){
           $command = $this->command;
        }        
        /* Maybe enable it later
        if($command->task != 'jcli'){
            return false;
        }
        */
       switch ( (string)$command->param[0] ){
           case 'debug':
               $this->_JCLI_debug($command);
               
       }
        //return TRUE;
        
    }
    
    /*
     * JCLI Debug
     * 
     * @var         string      $command: command to excecute
     *  
     * @return      bool        TRUE if no errors
     * 
     * @since       0.3
     */
    private function _JCLI_debug( $command = NULL ){
        //If is unset, load from $this->command
        if($command === NULL){
           $command = $this->command;
        }
        $this->out_s("\nDEBUG variables\n");
        $this->out_s( '$command' );        
        $this->out_s( $command );
        $this->out_s( '$libraries' );        
        $this->out_s( $this->libraries );
        $this->out_s( '$user' );        
        $this->out_s( $this->user );
        
        //print_r($command);
        //$this->out_s( array('teste out_s', 'array2'));
        
        //return TRUE;        
    }
    
    /*
     * JCLI Load
     * Load commands
     *  
     * @return      void
     * 
     * @since       0.3
     */
    private function _JCLI_load( ){        
        foreach($this->command->task AS $item){
            
        }
    }
    
    /*
     * JCLI Exit
     * Terminate the JCli session
     *  
     * @return      void
     * 
     * @since       0.3
     */
    private function _JCLI_exit( ){        
        die('JCli end of session');
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
            
            $this->_parteLibrariesXml($path . $folder . DS . $folder  .'.xml');
            
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
    public function startupLogin( ){
        
        $this->screenLoad( 'login');
        
        if ( $this->user['sshkey'] == NULL || strlen($this->user['sshkey']) < 4 ){            
            $replateUser = $this->user;
            $replateUser['sshkey'] = _JCLI . DS. 'user' . DS . $user['username'] . '.ssh'. DS. 'id_rsa';            
            $this->setVar( 'user', $replateUser );
        }
        $this->out_s( 'Startup login test. Dump...');
        $this->out_s( 'Username: ' . $this->user['username'] . ' | Password:' . $this->user['password'] . ' | SSH Key Path: ' . $this->user['sshkey'] );
        $this->out_s( 'Login "ok"'. "\n\n");  
        //@todo...
        
        return TRUE;    
    }
    
   
    
    
     /**
     * Include file of one especific screen name
     * 
     * @param             string          $screen: name of screen to load
     *
     * @return  bool       TRUE if file load is fine, FALSE if is not
     *
     * @since   0.2
     */    
    public function screenLoad( $screen ){
        
            $path = _JCLI . '/sys/screen/'. $screen . '.php';

            if( is_file($path) ){
                include_once( $path );
                return true;
            } else {
                $this->logError('JCli->screenLoad: Failed to open '. $path);
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
     * Parse imput to obtain array of arguments arguments
     * Also reset $this->command, and reset if have something to add
     * 
     * @var             string          $input: the user input
     * 
     * @return          bool            TRUE if have, at least, one arg (function). Else return false
     * 
     * @since           0.3
     * 
     * @todo            Solve for cases that have '=' in params
     */
    private function _parseArgs( $input ){
        
      
        $this->command = new stdClass();
        $this->command->raw = $input;//RAW command for devs that do not want parset result
        
        $imputArray = explode(" ", $input );
        $nitems = count($imputArray);
        
        if( $nitems  == 0 ){//Maybe better this later
            return false;
        }        
        
        //@todo: Dirty. Rewrite later
        $i = 0;
        do {
            
            if( $imputArray[$i]{0} != '-'){
                $this->command->task[] = $imputArray[$i];
            } else {
                $imputArray[$i] = str_replace('-', '', $imputArray[$i]);
                $paramName = $imputArray[$i];
                $i++;//Move pointer for next value
                if( $i < $nitems ){ //Maybe end of array
                    $this->command->param[$paramName] = $imputArray[$i];
                    //@todo: remove " and ' not escaped
                } else {
                    $this->command->param[$paramName] = TRUE;
                }                
            }
            $i++;
        //Note: if user double spaces, will ignore nexts. 
        //Maybe change this behavior   
        } while ( isset($imputArray[$i]) && $imputArray[$i] != '' ); 
        return true;        
    }
   
    
    /* Error log
     * 
     */
    public function logError( $msg ){
        $log = date('Y-m-d H:i:s') . '> ';
        //Try convert arrays and objects to string
        if( is_array($msg) || is_a($msg) ){
            foreach($msg AS $item){
                $log .= $item . ' | ';
            }
        } else{
            $log = $log . $msg;
        }
        if( isset($this->$user['username'] )){
            $filename = $filename . '.log';
        } else {
             $filename = 'undefined.log';
        }

        if (!$handle = fopen( JCLI_LOG_PATH . DS .$filename , 'a+')) {
             echo 'Cannot open file ' . JCLI_LOG_PATH . DS .$filename;
            //die( 'Cannot open file ' . JCLI_LOG_PATH . DS .$filename );
        }

        if (fwrite($handle, $log . "\n") === FALSE) {
             echo 'Cannot write to file ' . JCLI_LOG_PATH . DS .$filename;
            //die( 'Cannot write to file ' . JCLI_LOG_PATH . DS .$filename );
        }
        fclose($handle);
    }
    
    /*
     * 
     */
   private function _parteLibrariesXml( $file ){
       
       if (is_file($file)){
          $xml = new SimpleXMLElement( $file ); 
       } else {
           $xml = FALSE;
       }
       return $xml;
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


