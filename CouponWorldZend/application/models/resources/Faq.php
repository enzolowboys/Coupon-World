<?php
    
class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'Faq';
    protected $_primary  = 'idfaq';
    protected $_rowClass = 'Application_Resource_faq_Item';
        
	public function init()
    {
    }
    /*inserisci le faq*/
    public function insertFaq($info){
        $this->insert($info);
    }
    /*tutte  le faq*/
    public function getFaq($paged=null,$order=null){
        
           $select= $this->select('faq.*');
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
    
    //Ritorna la faq corrispondente all'id
    public function getFaqById($id){
        
        $rowset = $this->find($id);
        $row = $rowset->current();
        return $row;
        
    }
        
    /* modifica faq*/
    public function updateFaq($value,$id){
                
        $adapter = $this->getAdapter();
        $where = $adapter->quoteInto("idfaq = ?", $id);
        $this->update($value,$where);
    }
        
    /* elimina le faq */
    public function deleteFaq($id){
        $this->delete(Array("idfaq = ?" => $id));
            
    }
    
    /*estrae le aziende in base all'id*/
    public function getFaqById($id){
        
      
        $rowset = $this->find($id);
        $row = $rowset->current();
        return $row;
    }
        
}