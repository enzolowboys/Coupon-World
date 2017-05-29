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
     /*insersci utenti */
    public function insertUser($info)
    {
           return $this->getResource('User')->insertUser($info);
    }
    
    /*estrae tutti utenti  */
    public function getAllUser()
    {
        return $this->getResource('User')->getAllUser();
        
    }
    

    /* elimina l'utente  */
     public function deleteUser($iduser){
          return $this->getResource('User')->deleteUser($iduser);
     }
     
     /*visualizza tutte le faq*/
      public function getFaq($id){
            return $this->getResource('Faq')->getFaq();
            
        }
     
     
        /*inserisci faq*/
        public function insertFaq($info){
            return $this->getResource('Faq')->insertFaq($info);
        }
        /*eleimina faq */
        public function deleteFaq($id){
            return $this->getResource('Faq')->deleteFaq($id);
            
        }
        
        /*modifca faq*/
        
        public function updateFaq($id){
            
            return $this->getResource('Faq')->updateFaq($id);
            
            
        }
        
        
        
}