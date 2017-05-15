<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {


    function protected _initViewSettings() {
        
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        
        
    }
}

