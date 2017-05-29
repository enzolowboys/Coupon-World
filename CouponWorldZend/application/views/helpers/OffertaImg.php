<?php

class Zend_View_Helper_OffertaImg extends Zend_View_Helper_HtmlElement {
    
    public function offertaImg ($imgFile, $_attrs=false) {
        
      if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}
      if (null !== $_attrs) {
			$_attrs = $this->_htmlAttribs($_attrs);
        }
        else {
			$_attrs = '';
		}
      $tag = '<img src="' . $this->view->baseUrl('images/offerte/'.$imgFile) . '" ' .$_attrs.'>';
      return $tag;
    }
}