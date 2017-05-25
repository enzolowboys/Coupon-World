<?php

class Application_Model_User extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
        
       
        
        
        
        /*una volta inserito il nome del brand carica l'id di quest'ultimo nella variabile idazienda 
 poi usa la funzione getpromobyazienda per estrarre tutte le promozioni  di quell'azienda       */
public function SearchPromozioneByBrands($nome, $paged=null, $order=null){
    $idazienda= $this->getResource('Azienda')->getAziendaByNome($nome);
    return $this->getResource('promozione')->getPromozioneByAzienda($idazienda,$paged,$order);
}


        
        
        
        
}