<?php

class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
        
       
        /*prende la promozione in base al nome */
        public function getPromozioneById($id){
            return $this->getResource('Promozione')->getPromozioneById($id);
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
        
        /*estrae gli elementi in base alla data odierna*/
        
        public function getPromozioneByDate($paged=null,$order=null){
           return $this->getResource('Promozione')->getPromozioneByDate($paged,$order);
         }
         /*promozioni che scadono in base alla data odierna */
      public function getPromozioneByLastDate($paged=null,$order=null){
            return $this->getResource('Promozione')->getPromozioneByLastDate($paged,$order);
      }  
      /*promozioni che scadono   entro un giorno partendo dalla data odierna */
      public function getPromozioniInscadenza($paged=null,$order=null){
            return $this->getResource('Promozione')->getPromozioniInscadenza($paged,$order);
      }
      /*promozione inserite di recente cioè la differenza tra la data odierna e la data di inzio è maggiore= 0 */
      public function getPromozioniInsRecenti($paged=null,$order=null){
            return $this->getResource('Promozione')->getPromozioniInsRecenti($paged,$order);
      }
              

        /*una volta inserito il nome del brand carica l'id di quest'ultimo nella variabile idazienda 
 poi usa la funzione getpromobyazienda per estrarre tutte le promozioni  di quell'azienda       */
        public function SearchPromozioneByAzienda($nome, $paged=null, $order=null){
   
            return $this->getResource('Promozione')->getPromozioneByAzienda($nome,$paged,$order);

        }
        
        public function searchPromozioneByNome($nome,$paged=null,$order=null) {
            
            return $this->getResource('Promozione')->getPromozioneByName($nome,$paged,$order);
        }
        
        public function getAziendaById($id){
        
            return $this->getResource('Azienda')->getAziendaById($id);
        }
        
        public function getAzienda() {
            
            return $this->getResource('Azienda')->getAzienda();
        }
        public function getAziendaByNome($nome) {
            
            return $this->getResource('Azienda')->getAziendaByNome($nome);
        }


        
        public function insertUser($info){
           return $this->getResource('User')->insertUser($info);
        }
        
        public function cercaPromozione($tipologia,$ricerca,$paged=null,$order=null){
            return $this->getResource('Promozione')->Searchpromozione($tipologia,$ricerca,$paged,$order);
        }   
        
        public function getTipologie() {
            
            return $this->getResource('Tipologia')->getAllTipologie();
        }

        public function getPromozioneByDateAzienda($nome) {
            
            return $this->getResource('Promozione')->getPromozioniInscadenzaTipologia($nome);
        }
        
         public function getPromozioneByDateTipologia($nome) {
            
            return $this->getResource('Promozione')->getPromozioneByDateTipologia($nome);
        }
        
        public function getPromozioniInscadenzaTipologia($nome){
            
            return $this->getResource('Promozione')->getPromozioniInscadenzaTipologia($nome);
        }
        
         public function getPromozioneByTipologiaAzienda($tipologia,$nome,$paged){
             
             return $this->getResource('Promozione')->getPromozioneByTipologiaAzienda($tipologia,$nome,$paged);
         }
      

        public function getFaq(){
        
            return $this->getResource('Faq')->getFaq();
        }
}