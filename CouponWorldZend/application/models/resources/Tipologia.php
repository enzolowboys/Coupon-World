<?php

class Application_Resource_Tipologia extends Zend_Db_Table_Abstract {
    
    
    protected $_name    = 'tipologia';
    protected $_primary  = 'idtipologia';
    protected $_rowClass = 'Application_Resource_Tipologia_Item';
    
    public function init() {
        
    }
    
 
    /*Senza Paginator*/
    public function getAllTipologie() {
         $select= $this->select();
         return $this->fetchAll($select);
    }
        
    public function insertTipologia($info){
        $this->insert($info);
    }
    
    /*Con Paginator*/  
    public function getTipologie($paged=null,$order=null) {
        
        $select= $this->select();
        if(true === is_array($order)){
            $select->order($order);
        }
        if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(10)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
                            
            }
        return $this->fetchAll($select);
    }
        
    
    public function deleteTipologia($id){
    
    
        $this->delete(Array("idtipologia = ?" => $id));
            
    }
    
    public function getTipologiaById($id){
        
        $rowset = $this->find($id);
        $row = $rowset->current();
        return $row;
    }
    
    public function updateTipologia($value,$id){
        
        $adapter = $this->getAdapter();
        $where = $adapter->quoteInto("idtipologia = ?", $id);
        $this->update($value,$where);
        
        
    }
        
     /* prende lid dell'azienda dal nome */
    public function getIdTipologiaByNome($nome){
        //$tipologia='Tecnologia';
        return $this->fetchRow ($this->select()->where( 'nometipologia = ?',$nome));
            
    }   
}
