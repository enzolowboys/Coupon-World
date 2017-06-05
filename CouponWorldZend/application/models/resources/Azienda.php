<?php

class Application_Resource_Azienda extends Zend_Db_Table_Abstract
{
    protected $_name    = 'azienda';
    protected $_primary  = 'idazienda';
    protected $_rowClass = 'Application_Resource_Azienda_Item';
    
	public function init()
    {
    }
    /*estrae le aziende in base all'id*/
    public function getAziendaById($id){
        $azienda = $this->find($id);
        return $this->fetchAll($azienda);
    }
    /*estrae le aziende in base la partita iva*/
    public function getAziendaBypartitaiva($partitaiva){
        
        return $this->fetchAll($this->select()->where( 'partitaiva='.$partitaiva));
        
    }
    /*estrae le aziende in base al nome*/
    public function getAziendaByNome($nome){
        
        return $this->fetchAll($this->select()->where( 'nome ='.$nome));
        
    }
    /* prende lid dell'azienda dal nome */
    public function getIdAziendaByNome($nome){
        
        return $this->fetchAll($this->select('azienda.idazienda')->where( 'nome ='.$nome));
        
    }
    /*resctituisce id dellazienda con quel nome */
    public function getIdAzienda($nome){
        
        return $this->fetchAll($this->select('idazienda')->where( 'nome'.$nome));
 
    }
    public function getAzienda() {
        
        $select= $this->select();
        return $this->fetchAll($select);
    }
    
    /*inserisci azienda*/
    public function insertAzienda($info){
        $this->insert($info);
        
    }
    
    /*modifica aziende */
    public function updateAzienda($info,$id){
        $this->update($info, $id);
    }
    /*elimina azienda */
    public function deleteAzienda($id){
        $this->delete($id);
    }
    
    
    
    
    
}