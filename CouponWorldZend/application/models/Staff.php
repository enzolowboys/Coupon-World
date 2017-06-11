<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct(){
		$this->_logger = Zend_Registry::get('log');  	
	}
        
        
        
        /*funzione per estrarre tutte le promozioni*/
    public function getAllPromozione(){
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

    
    
    /*estrae i dati dell'utente */
    public function getUserById($id)
    {
        return $this->getResource('User')->getUserById($id);
    }
    
    public function updateUser($value,$id) {
        
        return $this->getResource('User')->updateUser($value,$id);
    }

     public function getTipologie() {
        
         return $this->getResource('Tipologia')->getAllTipologie();
     }
     
     public function getIdAziendaByNome($nome){
        
        return $this->getResource('Azienda')->getIdAziendaByNome($nome);
        
    }
    
         public function getIdTipologiaByNome($nome){
        
        return $this->getResource('Tipologia')->getIdTipologiaByNome($nome);
        
    }
    
    public function getAziende(){
        
        return $this->getResource('Azienda')->getAzienda();
    }
    
    public function getPromozioneById($id){
        

        return $this->getResource('Promozione')->getPromozioneByIdRow($id);

    }
    

        
}