<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon';
    protected $_primary  = 'idcoupon';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    
	public function init()
    {
    }
    /*estrai tutti i coupon di un user */
    public function searchCouponByIdUser($id){
       return $this->fetchAll($this->select()->where('coupon.user_iduser = ?',$id));
    }
/*ricerca i coupon tramite il suo di */
    public function searchCouponById($id){
        return $this->find($id);
    }
    
/*elimina coupon*/
    public function deleteCoupon($id){
         $this->delete($id);
    }

    
    
    public function insertCoupuon($info){
        
        $this->insert($info);
    }
    
    
}