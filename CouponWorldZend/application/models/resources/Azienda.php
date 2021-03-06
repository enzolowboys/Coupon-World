<?php
    
class Application_Resource_Azienda extends Zend_Db_Table_Abstract
{
    protected $_name    = 'azienda';
    protected $_primary  = 'idazienda';
    protected $_rowClass = 'Application_Resource_Azienda_Item';
        
	public function init()
    {
    }
    /*estrae le aziende in base all'id*/
    public function getAziendaById($id){
        
      
        $rowset = $this->find($id);
        $row = $rowset->current();
        return $row;
    }

    /*estrae le aziende in base al nome*/
    public function getAziendaByNome($nome){
        $select=$this->select('azienda.*')->where( 'nome = ?',$nome);
        return $this->fetchAll($select);
            
    }
    /* prende l'id dell'azienda dal nome */
    public function getIdAziendaByNome($nome){
        //$azienda='Adidas';
        return $this->fetchRow($this->select()->where('nome =?',$nome));
            
    }

    /*Senza paginator*/
    public function getAzienda() {
        $select= $this->select();
        return $this->fetchAll($select);
            
    }
     
    /*Con paginator*/
    public function getAziende($paged=null,$order=null) {
        
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
        
    /*inserisci azienda*/
    public function insertAzienda($info){
        $this->insert($info);
            
    }
        
    /*modifica aziende */
    public function updateAzienda($info,$id){
        
        $adapter = $this->getAdapter();
        $where = $adapter->quoteInto("idazienda = ?", $id);
        $this->update($info,$where);
    }
    /*elimina azienda */
    public function deleteAzienda($id){
        $this->delete(Array("idazienda = ?" => $id));
    }
        
        
        
        
        
}