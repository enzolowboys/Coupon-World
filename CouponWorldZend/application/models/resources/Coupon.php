<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'idcoupon';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    
	public function init() {
        $this->_logger = Zend_Registry::get("log"); //file log
    }

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
    
    public function verificaCoupon($iduser,$idpromozione) {
        
        $select = $this->select();
        $select->from($this, array('count(*) as amount'))
                ->where('promozione_idpromozione=?',$idpromozione)
                ->where('user_iduser=?',$iduser);
        $rows = $this->fetchAll($select);
        
        if($rows[0]->amount > 0)
            return true;
        else
            return false;
        
    }

    
}