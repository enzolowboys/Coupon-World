<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'iduser';
    protected $_rowClass = 'Application_Resource_User_Item';
    
    
	public function init()
    {
    }
    
    // Estrae gli utenti in base all' $id
    public function getUserById($id)
    {
        return $this->find($id)->current();
    }
     // Estrae gli utenti in base alla tipologia 
    public function getUserByTipe($t)
    {
     
            $select= $this->select()
                    ->where($t = 'tipo');
                    
    
        return $this->fetchAll($select);
        
    }
    
    /*inserisci utenti*/
    
     public function insertUser($info)
    {
    	$this->insert($info);
    }
    /*elimina un utante usando il suo username*/
    public function deleteUser($username){
        $this->delete($username);
    }
    
    /*modifica utente*/
    public function updateUser($info,$username){
        $this->update($info, $username);
    }
    
    
    
    
    
    
}