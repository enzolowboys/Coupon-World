<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Faq';
    protected $_primary  = 'idfaq';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
	public function init()
    {
    }
    /*inserisci le faq*/
    public function insertFaq($info){
        $this->insert($info);
    }
    /*tutte  le faq*/
    public function getFaq(){
        $select= $this->select();
        return $this->fetchAll($select);
                
    }
    
    /* modifica faq*/
    public function updateFaq($id){
        $this->updateFaq($id);
    }
            
    /* elimina le faq */
    public function deleteFaq($id){
        $this->delete($id);
        
    }
    
    
}