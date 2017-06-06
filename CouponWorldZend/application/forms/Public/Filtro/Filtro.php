<?php

class Application_Form_Public_Filtro_Filtro extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_publicModel;
    
    public function init(){
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('accedi');
        $this->setAction(''); //vuota in quanto si genera nel Controller
        
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //elemento grafico relativo all`username
        $this->addElement('select', 'nomedelfiltro', array(
            'label' => 'Filtra per:',
            'multiOptions' => array('tipologia' => 'tipologia', 'azienda' => 'azienda'), //1=maschio, 0=femmina
            'decorators' => $this->elementDecorators,
	));
        
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


