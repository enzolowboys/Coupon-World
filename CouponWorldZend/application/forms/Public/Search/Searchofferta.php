<?php

class Application_Form_Public_Search_Searchofferta extends App_Form_Abstract {
    
    
    public function init() {
        
        //Setto le impostazioni della form
        $this->setMethod('post');
        $this->setName('ricercaOfferta');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //aggiungo la form di ricerca
        $this->addElement('text','cercaOfferta',array(
            'label'=>'',
            'filters'=>array('StringTrim'),
            'required'=>true,
            'description'=>'ricerca un offerta per categoria e tipologia',
            'decorators'=>$this->elementDecorators,
            ));
        
        $this->addElement('select', 'selezione', array(
            'label' => 'Ricerca per',
            'required'=>true,
            'multiOptions' => array('tipologia' => 'Tipologia', 'azienda' => 'Azienda','nomeprodotto'=>'Nome Offerta'),
			'decorators' => $this->elementDecorators,
	));
        
         //bottone di conferma per accedere
        $this->addElement('submit', 'cerca', array(
            'label' => '',
            'decorators' => $this -> buttonDecorators,
	));
        //decorators
        $this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
			array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
			'Form'
		));
    }
    
    
}