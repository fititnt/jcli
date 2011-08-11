<?php
/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
defined('_JCLI') or die();


class JCMS extends JCliExtended {
    
    /*
     * Current project
     *
    */
    var $project;
    
    /*
     * Current extension
    */
    var $extension;
    
    
    
    public function JCMS(){


    }  
    
    
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
        //...
        
    }
    
	public function com_content( $command ){
	
		
            switch( (string)$command->task ){
                    case 'ls' :
                    case 'list':

                            break;
                    case'del':
                    case'delete':
                    case'remove':

                            break;

                        default:
                    }

        }

	public function com_users( ) {
	
	
	}
	
	public function com_admin( ) {
	
	}
	
	
	public function com_banners(){
	
	} 
    
    
}