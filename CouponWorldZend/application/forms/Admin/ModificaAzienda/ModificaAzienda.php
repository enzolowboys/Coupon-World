<?php
    
class Application_Form_Admin_ModificaAzienda_ModificaAzienda extends App_Form_Abstract {
    
    //definisco la variabile per la connessione al database
    protected $_adminModel;
        
    public function init(){
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');

        $this->setName('modificaazienda');

        $this->setAction(''); //vuota in quanto si genera nel Controller
            
        //per la gestione degli elementi di tipo file
        $this->setAttrib('enctype', 'multipart/form-data');
            
        //elemento grafico relativo al nome dell'azienda
        $this->addElement('text', 'nome', array(
            'label' => 'Nome Azienda',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'description' => 'Inserisci il nome dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
            
        //elemento grafico relativo alla ragione sociale
        $this->addElement('text', 'ragionesociale', array(
            'label' => 'Ragione Sociale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci il nome dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
            
        //elemento grafico relativo al settore
        $this->addElement('text', 'settore', array(
            'label' => 'Settore',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci il nome dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
         //elemento grafico relativo alla partita iva
        $this->addElement('text', 'partitaiva', array(
            'label' => 'Partita Iva',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci la partita IVA dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo alla descrizione
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => false,
            'validators' => array(array('StringLength',true, array(1,2500))),
			'decorators' => $this->elementDecorators,
	));
                    
        //elemento grafico relativo all'indirizzo
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci l`indirizzo dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));            
        
        //elemento grafico relativo alla città 
        $this->addElement('text', 'citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci l`indirizzo dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));  
                    
        //elemento grafico relativo al paese
        $this->addElement('text', 'paese', array(
            'label' => 'Paese',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci l`indirizzo dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
        //elemento grafico relativo al telefono
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'description' => 'Inserisci l`indirizzo dell`azienda',
            'decorators' => $this ->elementDecorators,
        ));
        
        
        // elemento grafico relativo alla email
        $this->addElement('text', 'email', array(
            'label'      => 'La mail dell`azienda',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'decorators' => $this ->elementDecorators,
            'validators' => array(
            'EmailAddress',
            )
        ));
        
                //elemento grafico relativo alla foto profilo
        $this->addElement('file', 'foto', array(
            'label' => 'Immagine',
	     'required'   => true,
            'destination' => APPLICATION_PATH . '/../public/images/brands',
            'validators' => array( 
            array('Count', false, 1),
            array('Size', false, 2024000), 
            array('Extension', false, array('jpg', 'gif','png'))),
           'decorators' => $this->fileDecorators,
	));
        
        
        //elemento grafico relativo al bottone conferma
        $this->addElement('submit', 'inserisci', array(
            'label' => 'Aggiorna',
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
