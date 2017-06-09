<?php

class Application_Form_Admin_ModificaUtente_ModificaUtente extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
 
    
    public function init() 
    {
        
        
        $this->setMethod('post');
        $this->setName('registra');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(3,20))),
            'required' => true,
            'description' => 'Inserisci il tuo nome',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al cognome
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(3,20))),
            'required' => true,
            'description' => 'Inserisci il tuo cognome',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al sesso
        $this->addElement('select', 'sesso', array(
            'label' => 'Sesso',
            'multiOptions' => array('1' => 'M', '0' => 'F'), //1=maschio, 0=femmina
            'decorators' => $this->elementDecorators,
	));
        
        //elemento grafico relativo all' etá
        $this->addElement('text', 'eta', array(
            'label' => 'Etá',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', false, array(1,3))), //false perché non deve proseguire se non é soddisfatto
            'required' => true,
            'description' => 'Inserisci il tuo cognome',
            'decorators' => $this ->elementDecorators,
        ));
         
        //elemento grafico relativo al numero di telefono
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', false, array(3,10))), //false perché non deve proseguire se non é soddisfatto
            'required' => true,
            'description' => 'Inserisci il tuo numero di telefono',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo all'indirizzo
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', false, array(3,20))), //false perché non deve proseguire se non é soddisfatto
            'required' => true,
            'description' => 'Inserisci il tuo indirizzo',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla cittá
        $this->addElement('text', 'citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', false, array(3,20))), 
            'required' => true,
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
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(3,20))),
            'required' => true,
            'description' => 'Inserisci il tuo username scelto',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla password
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(3,20))),
            'required' => true,
            'description' => 'Inserisci la tua password scelta',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla foto profilo
        $this->addElement('file', 'foto', array(
            'label' => 'Immagine',
            'destination' => APPLICATION_PATH . '/../public/images/fotoutenti',
                'validators' => array( 
          array('Count', false, 1),
           array('Size', false, 202400), //9 mb per l'img
         array('Extension', false, array('jpg', 'gif'))),
           'decorators' => $this->fileDecorators,
	));
        
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'modifica', array(
            'label' => 'Modifica',
			'decorators' => $this->buttonDecorators,
	));
        
        //setto i decorators
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table','class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
	));
        
    }
}
