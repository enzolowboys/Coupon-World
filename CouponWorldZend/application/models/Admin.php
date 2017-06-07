<?php

class Application_Model_Admin extends App_Model_Abstract
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
    public function getAllUser($paged)
    {
        return $this->getResource('User')->getAllUser($paged);
        
    }
    

    /* elimina l'utente  */
     public function deleteUser($iduser){
          return $this->getResource('User')->deleteUser($iduser);
     }
     
     /*visualizza tutte le faq*/
      public function getFaq($paged){
            return $this->getResource('Faq')->getFaq($paged);
            
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
        
        public function insertAzienda($azienda){
            return $this->getResource('Azienda')->insertAzienda($azienda);
        }
        
        public function insertTipologia($info){
            return $this->getResource('Tipologia')->insertTipologia ($info);
        }
        
        /*prende il nome dell'azoenda l'username dell utente e i li mette in relazione */
        public function insertRelazione($nome,$username){
            $idazienda= $this->getResource('Azienda')->getIdAziendaByNome($nome);
            $iduser= $this->getResource('User')->getIdUser($username);
           /**/ $info= array('',$idazienda,$iduser);
            return $this->getResource('Relazione')->isertRelazione($info);
        }
        
        public function getAziende($paged) {
            
            return $this->getResource('Azienda')->getAziende($paged);
            
        }
        
        public function getTipologie($paged){
            
            return $this->getResource('Tipologia')->getTipologie($paged);
        }
        public function getStaff($paged=null,$order=null) {
            
            return $this->getResource('User')->getStaff($paged,$order);
        }
        
}