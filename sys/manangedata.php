<?php

/**
 * @package     JCliX
 * @author      Emerson Rocha Luiz - @fititnt ( http://fititnt.org )
 * @copyright   Copyright (C) Joomla! Coders Brazil @JCoderBR. All rights reserved.
 * @license     GNU General Public License version 3
 */
//defined('_JCLI') or die();//Commented for testing outise JCliX

/*
 * Class to manage data: save and load from disk
 * 
 * @author          Emerson Rocha Luiz ( emerson@webdesign.eng.br - http://fititnt.org )
 * 
 * @date            Created 2011-08-11 
 * 
 * @todo            Implement Encryptation               
 */
class StoreData {
    
    /*
     * Save data do disk
     * 
     * @var         mixed       $item: what would be saved to disk
     * 
     * @var         array       $param: params
     *                                  $param['storemethod'] = 'serialization'; //json
     *                                  $param['cryptograpy'] = FALSE; //Later set type
     *                                  $param['password'] = NULL;
     *                                  $param['file'] = '/place/to/store/file.ext';
     *                                  $param['backup'] = TRUE;
     *
    */
    public function dataSave( $item, $param ){
        
        //backup fist
        if($param['backup'] && is_file($param['file']) ){
            $this->_diskBackup($param['file']);
        }
        
        //Convert
        if($param['storemethod'] == 'serialization'){
            $dataToStore = $this->_dataSerialize( $item );
        } else {
            $dataToStore = $this->_dataJsonEncode( $item );
        }
        
        
        //Encrypt
        if( $param['cryptograpy'] ){
            $dataToStore = $this->_dataEncrypt( $dataToStore );
        }
        
        //Store
        if(! $this->_diskSave( $param['file'], $dataToStore) ){
            return FALSE;
        }
        return TRUE;
    }
    
    public function dataLoad( $file, $param ){
        
        if( !is_file($file) ){
            return FALSE;//Maybe Raize especific error
        }
        if( !is_readable($file) ){
            return FALSE;//Maybe Raize especific error
        }        
        $data = $this->_diskLoad( $file );
        
        //Convert
        if($param['storemethod'] == 'serialization'){
            $dataToStore = $this->_dataSerialize( $data );
        } else {
            $dataToStore = $this->_dataJsonEncode( $data );
        }
        
        //Decrypt
        if( $param['cryptograpy'] ){
            $data = $this->_dataDecrypt( $data, $param );
        }
        
        return $data;
    }
    
    
    private function _dataSerialize( $item ){
        
        $data = serialize($item);
        
        return $data;
        
    }
    
    private function _dataUnserialize( $item ){
        
        $data = unserialize($item);
        
        return $data;
        
    }
    
    private function _dataJsonEncode( $item ){
        
        $data = json_encode( $item );
        
        return $data;
        
    }
    
    private function _dataJsonDecode( $item ){
        
        $data = json_decode( $item );
        
        return $data;
        
    }
    
    private function _diskSave( $file , $item ){
        
        if (!$handle = fopen( $file , 'w+b')) { //Maybe binary later too
             return FALSE;
        }

        if (fwrite($handle, $item) === FALSE) {
             return FALSE;
        }
        fclose($handle);
        
        return TRUE;
        
    }
    
    private function _diskLoad( $file ){
        
        $data = file_get_contents($file);//Return false if do not load
        
        return $data;        
    }
    
    private function _diskBackup( $file, $newFile = NULL){
        
        if( $newFile === NULL){
            $newFile = $file . '.bkp';
        }
        
        if ( !copy($file, $newFile) ) { 
            return FALSE;
        } else{
            return TRUE;
        }
        
    }
    
    /*
     *  @todo
     */
    private function _dataEncrypt( $item ){
        
    }
    
    /*
     *  @todo
     */
    private function _dataDecrypt( $item ){
        
    }
    
}