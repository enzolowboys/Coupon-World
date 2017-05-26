<?php

class Application_Resource_Promozione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'promozione';
    protected $_primary  = 'idpromozione';
    protected $_rowClass = 'Application_Resource_Promozione_Item';
    
	public function init()
    {
    }
    /*estrae le promozioni in base  id */
    public function getPromozioneById($paged=null,$order=null){
           $select=$this->select();
            if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect(find($id));
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                
                
            }
        return $this->fetchAll($select);
    }
    /*estre le promozioni in base alla categoria*/
    public function getPromozioneByCategoria($categoria,$paged=null,$order=null){
        $select= $this->select()
                ->where('categoria = ?',$categoria);
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                
                
            }
        return $this->fetchAll($select);
        
        
    }
    
    /*estrae le promozioni in base alla tipologia*/
    public function getPromozioneByTipologia($tipologia,$paged=null,$order=null){
           $select= $this->select()
                ->where('tipologia = ?', $tipologia);
           if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                
                
            }
        
           return $this->fetchAll($select);
        
    }
    /*estrae le promozioni in base all'azienda*/
    public function getPromozioneByAzienda($idazienda,$paged=null,$order=null){
           $select= $this->select()
                ->where( 'idazienda = ?',$idazienda);
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                
                
            }
           return $this->fetchAll($select);
        
    }
   
    
   
  
   
   /*estrae le promozioni in base alla categorie e tipologia 
    * viene utilizzata nelle ricerca per categoria e tipologia */ 
    public function Searchpromozione($tipologia,$categoria,$paged=null,$order=null){
        //STA SBAGLIATA LA QUERY
        $select= $this->select()
                ->where('tipologia = ?',$tipologia&&'categoria ='. $categoria);
               
         if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                
        
      
    }  
    return $this->fetchAll($select);
    }
    
    /*estrae le promozioni con la data corrente*/
    public function getPromozioneByDate($paged=null,$order=null){
        $select= $this->select()
                ->where('datainizio = CURRENT_DATE()');
         if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
    
    }                   
       
        return $this->fetchAll($select);
    }
    
    /*estrae le promozioni in scadenza con la data corrente*/
    public function getPromozioneByLastDate($paged=null,$order=null){
        $select= $this->select()
                ->where('datafine =  CURRENT_DATE()');
         if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
    
    }                   
        return $this->fetchAll($select);
    }
    /* estrae le promozioni piu in scadenza cioè quando manca meno di due giorni alla scadenza*/
    public function getPromozioniInscadenza($paged=null,$order=null){
         $data = Zend_Date::now();
         $select=$this->select()
                ->where('datafine-'. $data. '> 2');
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(10)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
    
    }                   
       
        return $this->fetchAll($select);
        
        
         /* estrae le promozioni piu recenti cioè quando manca piu di due giorni alla scadenza*/
    }
 
    
     public function getPromozioniInsRecenti($paged=null,$order=null){
          $data = Zend_Date::now();
         $select=$this->select()
                ->where('datainizio-'. $data. '>= 1');
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$order){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
    
    }                   
       
        return $this->fetchAll($select);
        
        
        
    }

    /*inserisce promozioni*/
    public function insertPromozione($info){
        $this->insert($info);
             
    }
    /*modifica promozione*/
    
    public function updatePromozione($idpromozione,$info){
        $this->update($idpromozione,$info);
    }
    
    /*elimina promozione*/
    public function deletePromozione($idpromozione){
        $this->delete($idpromozione);
    }
    
    
    
    
    
    
}