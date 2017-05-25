<?php

class Application_Resource_promozione_Item extends Zend_Db_Table_Row_Abstract
{   
	public function getStatoPromozione()
        {
           $data = Zend_Date::now();
           $datafine = $this->datafine;
           if($data > $datafine){
                return $this->stato='f';
            }
           
        }
    
}