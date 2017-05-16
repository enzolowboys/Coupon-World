<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        
        /* Reindirizzo al public controller*/
        $this->_helper->redirector('index','public');
    }


}

