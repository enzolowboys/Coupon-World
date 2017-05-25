<?php

class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
        /*estrae gli elementi in base id*/
        public function getpromozioneByid(){
            return $this->getResource('Promozione')->getPromo();
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
        
        /*estrae gli elementi in base alla data*/
        
        public function getPromozioneByDate(){
           return $this->getResource('Promozione')->getPromozioneByDate();
         }
    


        /*una volta inserito il nome del brand carica l'id di quest'ultimo nella variabile idazienda 
 poi usa la funzione getpromobyazienda per estrarre tutte le promozioni  di quell'azienda       */
    public function SearchPromozioneByAzienda($nome, $paged=null, $order=null){
    $idazienda= $this->getResource('Azienda')->getAziendaByNome($nome);
    return $this->getResource('promozione')->getPromozioneByAzienda($idazienda,$paged,$order);
        }






}