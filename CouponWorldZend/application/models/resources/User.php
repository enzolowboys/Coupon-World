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
        
    //la funzione ritorna l'utente per username
    public function getAllUser($paged=null,$order=null)
    {
        
       $select= $this->select();
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(10)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
                            
            }
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
    
    public function getUserByName($info){
        
        $select=$this->select()
                ->where('user.username=?',$info);
        return $this->fetchRow($select);
    }
        
    /*inserisci utenti*/
        
     public function insertUser($info)
    {
    	$this->insert($info);
    } 
        
    /*elimina un utante usando il suo id*/
    public function deleteUser($iduser){
    
    
        $this->delete(Array("iduser = ?" => $iduser));
            
    }
        
    /*modifica utente*/
    public function updateUser($info,$username){
        $this->update($info, $username);
    }
    
    public function getStaff($paged=null,$order=null){
        $role="staff";       
        $select= $this->select()
                       ->where('user.role=?',$role);
        if(true === is_array($order)){
            $select->order($order);
        }
            if(null !=$paged){
                $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(10)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
                            
                            
            }
        return $this->fetchAll($select);
            
    }

        
        
        
        
        
        
}