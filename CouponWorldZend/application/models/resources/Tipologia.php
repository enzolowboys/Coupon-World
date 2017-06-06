<?php

class Application_Resource_Tipologia extends Zend_Db_Table_Abstract {
    
    
    protected $_name    = 'tipologia';
    protected $_primary  = 'idtipologia';
    protected $_rowClass = 'Application_Resource_Tipologia_Item';
    
    public function init() {
        
    }
    
    public function getTipologiaByName($tipologia) {
       return $this->fetchRow($this->select()->where('nometipologia = ?', $tipologia));
    }
    
    public function getAllTipologie() {
         $select= $this->select();
         return $this->fetchAll($select);
    }
    
    public function insertTipologia($info){
        $this->insert($info);
    }
     
    
}
