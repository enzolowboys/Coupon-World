<?php

class Application_Form_Public_Filtro_FiltroTipologia extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_publicModel;
    
    public function init(){
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('filtrotipologia');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //carico dal database tutte le tipologia      
        $listaTipologie = array();
        $tipologie = $this->_publicModel->getTipologie();
        foreach ($tipologie as $tipologia) {
        	$listaTipologie[$tipologia -> nometipologia] = $tipologia->nometipologia;       
        }
        $this->addElement ( 
    'radio', 'Filtro', 
    array (
        'multiOptions' => $listaTipologie,
        'decorators' => $this->elementDecorators,
                
           )
        );
        //bottone di conferma per accedere
                //bottone di conferma per accedere
        $this->addElement('submit', 'filtra', array(
            'label' => 'Filtra',
            'decorators' => $this ->buttonDecorators,
	));
        
        
        
        // setto il decorator
        $this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
			array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
			'Form'
		));
       
         
    }
}