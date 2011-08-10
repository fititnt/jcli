<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();


class JBKP extends JCliExtended {
    
    /*
     * Current project
     *
    */
    var $project;
    
    /*
     * Current extension
    */
    var $extension;
    
    /*
     * Current extension
     * 
     * @todo: be sure that does not need move it later
    */
    var $email;
    
    /*
     * 
     */
    public function backup( $arguments, $project = NULL, $extension = NULL){
        
        if ($project == NULL && $extension == NULL){
            //@todo: Trow some error
            return FALSE;
        }
        
        if($project == NULL){
            if($this->project){
                $project = $this->project;
            }            
        }
        if($extension == NULL){
            if ($this->extension){
                $extension = $this->extension;
            }            
        }        
        // For database data ask help from
        // jdb      

        // For files data ask help from
        // (?)        
        //...
        return true;
    }
    
    /*
     * Send backup by email
     */
    public function email($email = NULL /* sure more params here */){
        
        //Call jmail sendmail
        
        return true;        
    }
    
    
}