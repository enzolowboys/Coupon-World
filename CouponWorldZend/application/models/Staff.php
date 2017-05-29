<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
        
        
        
        /*funzione per estrarre tutte le promozioni*/
        public function getALlPromozione(){
             return $this->getResource('Promozione')->getAllPromozione();
        }
        
        
       /*funzione per eliminare le promozioni*/
        public function deletePromozione($id){
             return $this->getResource('Promozione')->deletePromozione($id);
        }
        
        
        /*funzione per modificare le promozioni */
        public function updatePromozione($idpromozione,$info){
             return $this->getResource('Promozione')->updatePromozione($idpromozione,$info);
        }
        
        /*funzione per iserire promozioni*/
        public function insertPromozione($info){
             return $this->getResource('Promozione')->insertPromozione($info);
        }
        
       /*modifica utente*/
         public function updateUser($info,$username){
        return $this->getResource('User')->updateUser($info, $username);
    }
    
    
    /*estrae i dati dell'utente */
    public function getUserById($id)
    {
        return $this->getResource('User')->getUserById($id);
    }

        
        
}