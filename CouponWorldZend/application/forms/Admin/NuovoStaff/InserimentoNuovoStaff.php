<?php

class Application_Form_Admin_NuovoStaff_InserimentoNuovoStaff extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_adminModel;
        
    public function init(){
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('nuovostaff');
        $this->setAction(''); //vuota in quanto si genera nel Controller
            
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo al nome
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))),
            'description' => 'Inserisci il suo nome',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al cognome
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))), 
            'description' => 'Inserisci il suo cognome',
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
            'required' => true,
            'validators' => array(array('StringLength', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci il tuo cognome',
            'decorators' => $this ->elementDecorators,
        ));
         
        //elemento grafico relativo al numero di telefono
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci il suo numero di telefono',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo all'indirizzo
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci il suo indirizzo',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla cittá
        $this->addElement('text', 'citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', false, array(1,20))), 
            'description' => 'Inserisci la sua città',
            'decorators' => $this ->elementDecorators,
        ));
        
        // elemento grafico relativo alla email
        $this->addElement('text', 'email', array(
            'label'      => 'La sua Email',
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
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))), 
            'description' => 'Inserisci il tuo username scelto',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla password
        $this->addElement('text', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1,20))), 
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
        $this->addElement('submit', 'registrati', array(
            'label' => 'Conferma e Registralo',
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

