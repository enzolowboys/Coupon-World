<?php

class Application_Form_Staff_ModificaOfferta_ModificaOfferta extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_staffModel;
        
    public function init(){
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('modificaofferta');
        $this->setAction(''); //vuota in quanto si genera nel Controller
            
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome del prodotto
        $this->addElement('text', 'nomeprodotto', array(
            'label' => 'Nome Prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))),
            'description' => 'Inserisci il nome del prodotto',
            'decorators' => $this ->elementDecorators,
        ));
        
        //carico dal database tutte le categorie     
        $listaTipologie = array();
        $tipologie = $this->_staffModel->getTipologie();
        foreach ($tipologie as $tipologia) {
        	$listaTipologie[$tipologia -> nometipologia] = $tipologia->nometipologia;       
        }
        //elemento grafico relativo alla categoria del prodotto sotto promozione    
        $this->addElement('select', 'selezionetipologie', array(
            'label' => 'Categoria',
            'required'=>true,
            'multiOptions' =>$listaTipologie,
            'decorators' => $this->elementDecorators,
	));
        
        //carico dal database tutte le categorie     
        $listaBrands = array();
        $brands = $this->_staffModel->getAziende();
        foreach ($brands as $brand) {
        	$listaBrands[$brand -> nome] = $brand->nome;       
        }
        //elemento grafico relativo all'azienda del prodotto sotto promozione    
        $this->addElement('select', 'selezionebrands', array(
            'label' => 'Brands',
            'required'=>true,
            'multiOptions' =>$listaBrands,
            'decorators' => $this->elementDecorators,
	));
        
                //elemento grafico relativo ai giorni di validità della promozione
        $this->addElement('text', 'validita', array(
            'label' => 'Validità della promozione (in giorni) ',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,3))),
            'description' => 'Inserisci i giorni di validità della promozione',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al tipo di promozione (3x2,50%,..)
        $this->addElement('text', 'tipo', array(
            'label' => 'Tipo (3x2, 50%,..)',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))),
            'description' => 'Inserisci la tipologia dell`offerta (3x2, 50%,..)',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla descrizione dell'offerta
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione Offerta',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
			'decorators' => $this->elementDecorators,
	));
        
         //elemento grafico relativo alla modalità di fruizione della promozione
        $this->addElement('text', 'modalita', array(
            'label' => 'Modalità di fruizione',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))),
            'description' => 'Inserisci la modalità di fruizione',
            'decorators' => $this ->elementDecorators,
        ));
        
        //DATA INIZIO
        
        //DATA FINE
        
        //elemento grafico relativo alla foto profilo
        $this->addElement('file', 'immagine', array(
            'label' => 'Immagine Prodotto',
            'destination' => APPLICATION_PATH . '/../public/images/offerte',
		'required' => true,
          'validators' => array( 
          array('Count', false, 1),
          array('Size', false, 2024000), 
         array('Extension', false, array('jpg', 'gif','png'))),
           'decorators' => $this->fileDecorators,
	));
        
        //elemento grafico relativo alla localitá interessata della promozione
        $this->addElement('text', 'localita', array(
            'label' => 'Locaitá',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))),
            'description' => 'Inserisci la localitá interessata della promozione',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'inserisci', array(
            'label' => 'Conferma e Inserisci',
			'decorators' => $this->buttonDecorators,
	));
        
        //setto i decorators
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
	));
    }
}