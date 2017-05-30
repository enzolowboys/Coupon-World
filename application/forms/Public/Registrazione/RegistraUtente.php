<?php

class Application_Form_Public_Registrazione_RegistraUtente extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('registra');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci il tuo nome',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al cognome
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci il tuo cognome',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al sesso
        $this->addElement('select', 'discounted', array(
            'label' => 'Sesso',
            'multiOptions' => array('1' => 'M', '0' => 'F'), //1=maschio, 0=femmina
			'decorators' => $this->elementDecorators,
	));
        
        //elemento grafico relativo alla data di nascita
        
        
        //elemento grafico relativo al numero di telefono
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il tuo numero di telefono',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo all'indirizzo
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il tuo indirizzo',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla cittá
        $this->addElement('text', 'citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la tua città',
            'decorators' => $this ->elementDecorators,
        ));
        
        // elemento grafico relativo alla email
        $this->addElement('text', 'email', array(
            'label'      => 'La tua Email',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'decorators' => $this ->elementDecorators,
            'validators' => array(
                'EmailAddress',
            )
        ));
        
        //elemento grafico relativo all'username
        $this->addElement('text', 'username_registrazione', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci il tuo username scelto',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla password
        $this->addElement('text', 'password_registrazione', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', true, array(1,20))), 
            'description' => 'Inserisci la tua password scelta',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla foto profilo
        $this->addElement('file', 'image', array(
			'label' => 'Immagine',
			'destination' => APPLICATION_PATH . '/../public/images/offerte',
			'validators' => array( 
			array('Count', false, 1),
			array('Size', false, 902400), //9 mb per l'img
			array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
	));
        
       
        
        
        
        
        // elemento grafico relativo al captcha
        $this->addElement('captcha', 'captcha', array(
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 6,
                'timeout' => 300
            )
        ));
        
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'registrati', array(
            'label' => 'Conferma e Registrati',
			'decorators' => $this->buttonDecorators,
		));
        
    }
}
