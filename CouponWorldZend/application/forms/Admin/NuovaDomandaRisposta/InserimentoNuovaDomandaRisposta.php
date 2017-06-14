<?php

class Application_Form_Admin_NuovaDomandaRisposta_InserimentoNuovaDomandaRisposta extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_adminModel;
        
    public function init(){
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('nuovadomandarisposta');
        $this->setAction(''); //vuota in quanto si genera nel Controller
            
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo alla domanda
        $this->addElement('text', 'domanda', array(
            'label' => 'Domanda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 50))
            ),
            'description' => 'Inserisci la nuova tipologia',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla risposta
        $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
			'decorators' => $this->elementDecorators,
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

