<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'idcoupon';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    
	public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
    }
    /*estrai tutti i coupon di un user */
    public function searchCouponByIdUser($id){
       return $this->fetchAll($this->select()->where('coupon.user_iduser = ?',$id));
    }
    /*ricerca i coupon tramite il suo di */
    public function searchCouponById($id){
        return $this->find($id);
    }
    

    
    public function searchCouponByIdPromozione($idpromozione, $iduser){
        $select = $this->select('COUNT(*)')->where('coupon.promozione_idpromozione = ?',$idpromozione)->where('coupon.user_iduser = ?', $iduser);
        return $this->fetchRow($select);
        
    }
r
    /*elimina coupon*/
    public function deleteCoupon($id){
         $this->delete($id);
    }


    public function insertCoupon($info){
        
        $this->insert($info);
    }
    
    
    public function getAllCoupon(){

        
         $select= $this->select();
         return $this->fetchAll($select);
        
    }
    
    /*Funzione che conta il numero di coupon emessi per promozione*/
    public function getNumeroCouponPromozione($idPromozione) {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'))
                ->where('promozione_idpromozione=?',$idPromozione);
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
    /*Funzione che ritorna il numero totale di coupon emessi*/
    public function getNumeroCoupon() {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'));
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
        /*Funzione che conta il numero di coupon emessi per promozione*/
    public function getNumeroCouponUtente($iduser) {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'))
                ->where('user_iduser=?',$iduser);
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
    public function getCouponByUser($id,$paged=null,$order=null){
          $select= $this->select('coupon.*')
                ->joinLeft('promozione','coupon.promozione_idpromozione = promozione.idpromozione',array('promozione.*'))
                ->joinLeft('azienda', 'promozione.azienda_idazienda=azienda.idazienda',array('azienda.nome'))
                  ->joinLeft('tipologia', 'promozione.tipologia_idtipologia=tipologia.idtipologia',array('tipologia.nometipologia'))
                ->joinLeft('user','coupon.user_iduser = user.iduser',array('iduser'))
                ->where('user_iduser = ?',$id)
                
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

    
    public function getAllCoupon(){
        
         $select= $this->select();
         return $this->fetchAll($select);
        
    }
    
    /*Funzione che conta il numero di coupon emessi per promozione*/
    public function getNumeroCouponPromozione($idPromozione) {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'))
                ->where('promozione_idpromozione=?',$idPromozione);
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
    /*Funzione che ritorna il numero totale di coupon emessi*/
    public function getNumeroCoupon() {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'));
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
        /*Funzione che conta il numero di coupon emessi per promozione*/
    public function getNumeroCouponUtente($iduser) {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'))
                ->where('user_iduser=?',$iduser);
        $rows = $this->fetchAll($select);
       
        return($rows[0]->amount);    
    }
    
    public function getCouponByUser($id,$paged=null,$order=null){
          $select= $this->select('coupon.*')
                ->joinLeft('promozione','coupon.promozione_idpromozione = promozione.idpromozione',array('promozione.*'))
                ->joinLeft('azienda', 'promozione.azienda_idazienda=azienda.idazienda',array('azienda.nome'))
                  ->joinLeft('tipologia', 'promozione.tipologia_idtipologia=tipologia.idtipologia',array('tipologia.nometipologia'))
                ->joinLeft('user','coupon.user_iduser = user.iduser',array('iduser'))
                ->where('user_iduser = ?',$id)
                
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

    
}