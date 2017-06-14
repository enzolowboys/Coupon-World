<?php
    
class Application_Model_Admin extends App_Model_Abstract
{ 
    
	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
        /*funzione per estrarre tutte le promozioni*/
        public function getAllPromozione($paged){
             return $this->getResource('Promozione')->getAllPromozione($paged);
        }
            
            
       /*funzione per eliminare le promozioni*/
        public function deletePromozione($id){
             return $this->getResource('Promozione')->deletePromozione($id);
        }
              
        

       /*modifica utente*/
    public function updateUser($info,$id){
        return $this->getResource('User')->updateUser($info, $id);
    }
    
    public function getUserById($id){
        
        return $this->getResource('User')->getUserById($id);
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
      public function getFaq(){
            return $this->getResource('Faq')->getFaq();
                
        }
            
            
        /*inserisci faq*/
        public function insertFaq($info){
            return $this->getResource('Faq')->insertFaq($info);
        }
        /*eleimina faq */
            
            
        /*modifca faq*/
            
        public function updateFaq($id){
            
            return $this->getResource('Faq')->updateFaq($value,$id);
                
                
        }
            
        public function insertAzienda($azienda){
            return $this->getResource('Azienda')->insertAzienda($azienda);
        }
            
        public function insertTipologia($info){
            return $this->getResource('Tipologia')->insertTipologia ($info);
        }
        
        public function getTipologiaById($id){
            
            return $this->getResource('Tipologia')->getTipologiaById($id);
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
            
        public function deleteAzienda($id){
            
            return $this->getResource('Azienda')->deleteAzienda($id);
        }
            
        public function deleteFaq($id){
            
            return $this->getResource('Faq')->deleteFaq($id);
        }
            
        public function deleteTipologia($id){
            
            return $this->getResource('Tipologia')->deleteTipologia($id);
        }
            
        public function getAziendaById($id){
            
            return $this->getResource('Azienda')->getAziendaById($id);
        }
            
        public function updateAzienda($value,$id) {
            
            return $this->getResource('Azienda')->updateAzienda($value,$id);
        }
        
        public function updateTipologia($value,$id){
            
            return $this->getResource('Tipologia')->updateTipologia($value,$id);
        }
        
        public function getFaqById($id){
            
            return $this->getResource('Faq')->getFaqById($id);
                    
        }
        
  
        
        public function getNumeroCouponPromozione($idPromozione){
            
            return $this->getResource('Coupon')->getNumeroCouponPromozione($idPromozione);
        }
        
        public function getNumeroCoupon(){
            
            return $this->getResource('Coupon')->getNumeroCoupon();
        }
        
        public function getNumeroCouponUtente($iduser){
            
            return $this->getResource('Coupon')->getNumeroCouponUtente($iduser);
        }
        
       
}