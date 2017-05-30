<?php

class Application_Resource_Relazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'relazione';
    protected $_primary  = 'idrelazione';
    protected $_rowClass = 'Application_Resource_Relazione_Item';
    
	public function init()
    {
    }
    
   /*inserisce relazione*/
    public function insertRelazione($info){
        $this->insert($info);
    }
     /*controlla  ricerca relazioni*/
    public function searchRelazioneByIdUser($id){
        return $this->fetchAll($this->select()->where('relazione.user_iduser = ?',$id));
        
    }
    /*elimina relazione*/
    public function deleteRelazioneById($id){
        $this->delete($id);
    }
    
}