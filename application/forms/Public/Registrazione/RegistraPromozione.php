<?php

class Application_Form_Public_Registrazione_RegistraUtente extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('iserisciPromozione');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome del prodotto
        $this->addElement('text', 'nome', array(
            'label' => 'Nome Prodotto',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci nome del prodotto',
            'decorators' => $this ->elementDecorators,
        ));
        
   
        $this->addElement('text', 'categoria', array(
            'label' => 'Categoria',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci  la categoria',
            'decorators' => $this ->elementDecorators,
        ));
           
        
       
        $this->addElement('text', 'tipologia', array(
            'label' => 'Tipologia',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la tipologia',
            'decorators' => $this ->elementDecorators,
        ));
       
       
        $this->addElement('text', 'localita', array(
            'label' => 'Località',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la località',
            'decorators' => $this ->elementDecorators,
        ));
        
         
        $this->addElement('text', 'modalità', array(
            'label' => 'Modalità',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'descrivi la modalità di fruizione',
            'decorators' => $this ->elementDecorators,
        ));
        
         $this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione Prodotto',
             'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'descrivi la modalità di fruizione',
            'decorators' => $this ->elementDecorators,
        ));
        
        
    
        
        
        
        $this->addElement('file', 'image', array(
			'label' => 'immagine',
			'destination' => APPLICATION_PATH . '/../public/images/offerte',
			'validators' => array( 
			array('Count', false, 1),
			array('Size', false, 902400), //9 mb per l'img
			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
	));
        
       
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'registrati', array(
            'label' => 'Conferma e Registrati',
			'decorators' => $this->buttonDecorators,
		));
        
    }
}

