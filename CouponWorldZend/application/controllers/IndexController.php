<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        /*Reindirizzo al controller PUBLIC*/
        $this->_helper->redirector('index','public');
        
       
    }


}

