<?php

class Application_Form_Admin_ModificaTipologia_ModificaTipologia extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database

        
    public function init(){

        $this->setMethod('post');
        $this->setName('nuovatipologia');
        $this->setAction(''); //vuota in quanto si genera nel Controller
            
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo alla tipologia
        $this->addElement('text', 'nometipologia', array(
            'label' => 'Tipologia',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci la nuova tipologia',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla descrizione
        $this->addElement('textarea', 'descrizionetipologia', array(
            'label' => 'Descrizione',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
			'decorators' => $this->elementDecorators,
	));
        
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'modifica', array(
            'label' => 'Modifica',
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
