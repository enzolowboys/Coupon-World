<?php

class Application_Form_Public_Registrazione_RegistraAzienda extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('iserisciAzienda');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome dell azienda
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci nome dell azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
        
        $this->addElement('text', 'partitaiva', array(
            'label' => 'partitaIva',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci  la partita iva',
            'decorators' => $this ->elementDecorators,
        ));
       
         
        $this->addElement('text', 'email', array(
            'label'      => ' Email',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'decorators' => $this ->elementDecorators,
            'validators' => array(
                'EmailAddress',
            )
        ));
        
       
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il numero di telefono',
            'decorators' => $this ->elementDecorators,
        ));
      
        
        $this->addElement('text', 'fax', array(
            'label' => 'fax',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il numero di fax',
            'decorators' => $this ->elementDecorators,
        ));
        
        
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il  indirizzo',
            'decorators' => $this ->elementDecorators,
        ));
        
       
        $this->addElement('text', 'citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la  città',
            'decorators' => $this ->elementDecorators,
        ));
        
    
        
        $this->addElement('text', 'paese', array(
            'label' => 'Paese',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il paese',
            'decorators' => $this ->elementDecorators,
        ));
        
       
        $this->addElement('text', 'settore', array(
            'label' => 'Settore',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il settore',
            'decorators' => $this ->elementDecorators,
        ));
        
        
        $this->addElement('file', 'image', array(
			'label' => 'logo',
			'destination' => APPLICATION_PATH . '/../public/images/offerte',
			'validators' => array( 
			array('Count', false, 1),
			array('Size', false, 902400), //9 mb per l'img
			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
	));
        
       
        $this->addElement('text', 'ragione', array(
            'label' => 'Ragione Sociale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la ragione sociale dell azienda',
            'decorators' => $this ->elementDecorators,
        ));
       
        
        $this->addElement('text', 'descrizione', array(
            'label' => 'Descrizione Azienda',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci una breve descrizione dell azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
        
      
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'registrati', array(
            'label' => 'Conferma e Registrati',
			'decorators' => $this->buttonDecorators,
		));
        
    }
}

