<?php

class Application_Resource_Azineda extends Zend_Db_Table_Abstract
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
        
        return $this->select()->where( 'partitaiva='.$partitaiva);
        
    }
    /*estrae le aziende in base al nome*/
    public function getAziendaByNome($nome){
        
        return $this->select()->where( 'nome ='.$nome);
        
    }
    /*resctituisce id dellazienda con quel nome */
    public function getIdAzienda($nome){
        
        return $this->select('idazienda')->where( 'nome'.$nome);
 
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