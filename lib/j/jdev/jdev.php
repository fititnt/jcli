<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();


class JDEV extends JCliExtended {
    
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
     * 
     */
    public function _clone( $arguments = NULL, $project = NULL, $extension = NULL){ //CLone is a function on PHP. Pensar em contormar mais tarde o problema
        
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