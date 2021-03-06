<?php

class Application_Model_User extends App_Model_Abstract
{ 

	public function __construct() {
		$this->_logger = Zend_Registry::get('log');  	
	}
        
        
        
        /*estrae gli elementi in bae alla categoria*/
        public function getPromozioneByCategoria($categoria,$paged=null,$order=null){
             
            return $this->getResource('Promozione')->getPromozioneByCategoria($categoria,$paged,$order);
        }
        
        /*estrae gli elementi in base alla tipologia*/
        public function getPromozioneByTipologia($tipologia,$paged=null,$order=null){
            
            return $this->getResource('Promozione')->getPromozioneByTipologia($tipologia,$paged,$order);
        }
        
        /*estrae gli elementi in base alla gategoria e tipologia*/
        public function Searchpromozione($tipologia,$categoria,$paged=null,$order=null){
            
            return $this->getResource('Promozione')->Searchpromozione($tipologia,$categoria,$paged,$order);
        }
        
 
         
         /*promozioni che scadono in base alla data odierna */
        public function getPromozioneByLastDate($paged=null,$order=null){
            return $this->getResource('Promozione')->getPromozioneByLastDate($paged,$order);
        }  
        
        /*promozioni che scadono   entro un giorno partendo dalla data odierna */
        public function getPromozioniInscadenza($paged=null,$order=null){
            return $this->getResource('Promozione')->getPromozioniInscadenza($paged,$order);
        }
        
      /*prende la promozione in base al nome */
        public function getPromozioneById($id){
            
            return $this->getResource('Promozione')->getPromozioneById($id);
        }
              
        
        /*una volta inserito il nome del brand carica l'id di quest'ultimo nella variabile idazienda 
         poi usa la funzione getpromobyazienda per estrarre tutte le promozioni  di quell'azienda       */
        public function SearchPromozioneByAzienda($nome, $paged=null, $order=null){
   
            return $this->getResource('Promozione')->getPromozioneByAzienda($nome,$paged,$order);

        }

        /*inserisci  il coupon nella tabella */
        
        public function insertCoupon($info){
            
            return $this->getResource('Coupon')->insertCoupon($info);
        }
        
        public function updateUser($value,$id) {
        
            return $this->getResource('User')->updateUser($value,$id);
        }
    
        /*estrae i dati dell'utente */
        public function getUserById($id){
            
            return $this->getResource('User')->getUserById($id);
        }
    
        public function getUserByName($info){
            
            return $this->getResource('User')->getUserByName($info);
        }
    
        public function getStaff($paged=null){
        
            return $this->getResource('User')->getStaff($paged);
        }
    
        public function getCouponByUser($id,$paged){

        
            return $this->getResource('Coupon')->getCouponByUser($id,$paged);
        }
    
        public function searchCouponByIdPromozione($idpromozione, $iduser){
            
            return $this->getResource('Coupon')->searchCouponByIdPromozione($idpromozione, $iduser);
        
            
        }
    
        public function verificaCoupon($iduser,$idpromozione){
        
            return $this->getResource('Coupon')->verificaCoupon($iduser,$idpromozione);
            
        }
        
}