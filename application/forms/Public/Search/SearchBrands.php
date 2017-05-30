<?php

class Application_Form_Public_Search_SearchBrands extends App_Form_Abstract {
  
    
    
    protected $_publicModel;
    
    public function init(){
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('accedi');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo all`username
        $this->addElement('text', 'brand', array(
            'label' => '',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLenght', false, array(1,20))), //false perché non deve proseguire se non é soddisfatto
            'description' => 'Inserisci l`username scelto durante la registrazione',
            'decorators' => $this ->elementDecorators,
        ));
        
       
        
        //bottone di conferma per accedere
        $this->addElement('submit', 'cerca', array(
            'label' => '',
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

