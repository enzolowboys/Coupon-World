<?php
    
class Application_Resource_Promozione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'promozione';
    protected $_primary  = 'idpromozione';
    protected $_rowClass = 'Application_Resource_Promozione_Item';
        
	public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
    }
    
       
   /*estrae le promozioni in base alla categorie e tipologia 
    * viene utilizzata nelle ricerca per categoria e tipologia */ 
    public function Searchpromozione($tipologia,$ricerca,$paged=null,$order=null){
        
        $sql = array('0'); // Stop errors when $words is empty

        foreach($ricerca as $parola){
            $sql[] = 'promozione.descrizione LIKE "%'.$parola.'%"';
        }
 
        $select = $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('tipologia.nometipologia IN (?)',$tipologia)  
                ->where(implode(" OR ", $sql))
                ->where('promozione.datafine > CURDATE()')
                ->setIntegrityCheck(false);
                  $this->_logger->info('ricerca e'.print_r($select,true)); 
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

    /*inserisce promozioni*/
    public function insertPromozione($info){
        $this->insert($info);
            
    }
    /*modifica promozione*/
        

    public function updatePromozione($idpromozione,$info){
                
        $adapter = $this->getAdapter();
        $where = $adapter->quoteInto("iduser = ?", $id);
        $this->update($info,$where);
    }
        
    /*elimina promozione*/
    public function deletePromozione($idpromozione){
        $this->delete($idpromozione);
    }


        

    
    /* */    
    public function getAllPromozione($paged=null,$order=null){
        
        
      $select= $this->select('promozione.*')
                  ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                  ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia'))
              ->where('promozione.datafine > CURDATE()')
                    ->setIntegrityCheck(false); 
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
    
    /*estrae le promozioni in base  id */  
    public function getPromozioneById($id){
             
        $select= $this->select('promozione.*')
                  ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                  ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia'))
                  ->where('idpromozione=?',$id)
                  ->setIntegrityCheck(false); 
    
        return $this->fetchAll($select);

               

    }
    
        /*estrae le promozioni in base  id */  
    public function getPromozioneByIdRow($id){
             
        $select= $this->select('promozione.*')
                  ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                  ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia'))
                  ->where('idpromozione=?',$id)
                  ->setIntegrityCheck(false); 
    
        return $this->fetchRow($select);

               

    }
        
    /*estre le promozioni in base alla categoria*/
    public function getPromozioneByCategoria($categoria,$paged=null,$order=null){
        
           $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                   ->where('promozione.datafine > CURDATE()')
                ->where('tipologia.nometipologia = ?',$categoria)
                   ->setIntegrityCheck(false); 
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(6)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
                            
            }
        return $this->fetchAll($select);
            
            
    }
        
    /*estrae le promozioni con la data corrente*/
    public function getPromozioneByDate($paged=null,$order=null){
        $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datainizio = CURDATE()') ->setIntegrityCheck(false);
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
    
    /*estrae le promozioni con la data corrente e azienda*/
    public function getPromozioneByDateAzienda($nomeAzienda,$paged=null,$order=null){
         $select=$this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datafine-CURDATE() < 3') 
                 ->where('promozione.datafine > CURDATE()')
                  ->where( 'azienda.nome = ?',$nomeAzienda)
                 ->setIntegrityCheck(false);
               
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
        
    /*estrae le promozioni con la data corrente e azienda*/

    public function getPromozioneByDateTipologia($nomeTipologia,$paged=null,$order=null){
    //   $nomeTipologia='tecnologia';
        
        $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datainizio = CURDATE()')
                ->where('tipologia.nometipologia=?',$nomeTipologia) ->setIntegrityCheck(false);
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

    /*estrae le promozioni in scadenza con la data corrente*/
    public function getPromozioneByLastDate($paged=null,$order=null){
        $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datafine =  CURRENT_DATE()') ->setIntegrityCheck(false);
         if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(12)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
    }                   
        return $this->fetchAll($select);
    }
    
    /* estrae le promozioni piu in scadenza cioè quando manca meno di due giorni alla scadenza*/
    public function getPromozioniInscadenza($paged=null,$order=null){
        
         $select=$this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datafine-CURDATE() < 3') 
                ->where('promozione.datafine > CURDATE()')
                 ->setIntegrityCheck(false);
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
    }
        
    public function getPromozioniInscadenzaTipologia($nomedacercare,$paged=null,$order=null){
            
         $select=$this->select('promozione.*')
        
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.datafine-CURDATE() < 3') 
                 ->where('promozione.datafine > CURDATE()')
                ->where( 'tipologia.nometipologia = ?',$nomedacercare)
                 ->setIntegrityCheck(false);
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
      
    /* estrae le promozioni piu recenti cioè quando manca piu di due giorni alla scadenza*/         
    public function getPromozioniInsRecenti($paged=null,$order=null){
          $data = Zend_Date::now();
         $select=$this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                 ->where('promozione.datafine > ?',$data)
                ->where('promozione.datainizio-'. $data. '>= 0') ->setIntegrityCheck(false);
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
    
    
    /*estrae le promozioni in base alla tipologia e azienda*/
    public function getPromozioneByTipologiaAzienda($tipologia,$nome,$paged=null,$order=null){
           $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                   ->where('promozione.datafine > CURDATE()')
                ->where('tipologia.nometipologia = ?', $tipologia) 
                ->where('azienda.nome=?',$nome)->setIntegrityCheck(false);
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
    
    /* */
    public function getPromozioneByName($nome,$paged=null,$order=null){
           $select= $this->select('promozione.*')
                ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                ->where('promozione.nomeprodotto = ?', $nome) ->setIntegrityCheck(false);

           if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(1)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
                            
            }
                
           return $this->fetchAll($select);
               
    }
    
    /*estrae le promozioni in base all'azienda*/
    public function getPromozioneByAzienda($nomeAzienda,$paged=null,$order=null){
           $select= $this->select('promozione.*')
                   ->joinLeft('azienda','promozione.azienda_idazienda = azienda.idazienda',array('azienda.nome'))
                   ->joinLeft('tipologia','promozione.tipologia_idtipologia = tipologia.idtipologia',array('tipologia.nometipologia') )
                              ->where('promozione.datafine > CURDATE()')
             ->where( 'azienda.nome = ?',$nomeAzienda)->setIntegrityCheck(false);

        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(1)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
            }
           return $this->fetchAll($select);
               
    }
    
        
}