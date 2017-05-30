<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'iduser';
    protected $_rowClass = 'Application_Resource_User_Item';
    
    
	public function init()
    {
    }
     /*public function get id user by username*/
    public function getIdUser($username){
        $select= $this->select('user.iduser')
                ->where('username = ?',$username);
        return $this->fetchAll($select);
    }

    public function getAllUser()
    {
         $select= $this->select();
         return $this->fetchAll($select);
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
    public function deleteUser($iduser){
        $this->delete('iduser = ? ',$iduser);
        
    }
    
    /*modifica utente*/
    public function updateUser($info,$username){
        $this->update($info, $username);
    }
    
    
    
    
    
    
}