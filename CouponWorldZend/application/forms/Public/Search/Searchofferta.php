<?php

    
class Application_Form_Public_Search_Searchofferta extends App_Form_Abstract {
    
    protected $_PublicModel;
        
    public function init() {
        
        $this->_PublicModel = new Application_Model_Public();
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

                
        //carico dal database tutte le tipologia      
        $listaTipologie = array();
        $tipologie = $this->_PublicModel->getTipologie();
        foreach ($tipologie as $tipologia) {
        	$listaTipologie[$tipologia -> nometipologia] = $tipologia->nometipologia;       
        }
            
        $this->addElement('select', 'selezione', array(
            'label' => 'Ricerca',
            'required'=>true,
            'multiOptions' =>$listaTipologie,
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