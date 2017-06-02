<?php

class Application_Service_Auth
{
    protected $_userModel;
    protected $_auth;

    /*
     * Con questa funzione, si fa in modo
       che ogni volta che viene istanziato un oggetto di questa classe, si
       istanzia il suo modello dei dati.
     */
    public function __construct()
    {
      
        //creo la struttura dati 
        $this->_userModel = new Application_Model_User();
        $this->_logger = Zend_Registry::get("log"); //file log
    }
    
    public function authenticate($credentials)
    {
        
        /*vado a definire un adapter da usare per Zend_-
         * Auth. ovvero il canale di reperimento delle informazioni. Si
         * attiva quindi, il metodo authenticate() dell’oggetto Zend_-
         *Auth, a cui si passa l’adapter (si sta qui definendo un adapter
         *specifico da usare nella public).
         * 
         */
        $adapter = $this->getAuthAdapter($credentials); //il metodo si trova alla fine
        $auth  = $this->getAuth();
        /*
         * il metodo autheticate ritorna vero o falso e costruisce l'autenticazione
         * predefinita
         */
        $result = $auth->authenticate($adapter);

        if (!$result->isValid()) {
            return false;
        }
        //estraggo l'user dal database
        $user = $this->_userModel->getUserByName($credentials['username']);
        /*lo memorizzo in una struttura permanente in Zend_Auth*/
        $auth->getStorage()->write($user);
        return true;
    }
    
    /*estrae l'oggetto auth*/
    public function getAuth()
    {
        if (null === $this->_auth) {
            $this->_auth = Zend_Auth::getInstance();
        }
        return $this->_auth;
    }
   
    //estrae l'identità
    public function getIdentity()
    {
        $auth = $this->getAuth();
        if ($auth->hasIdentity()) {
            return $auth->getIdentity();
        }
        return false;
    }
    
    /*per il logout*/
    public function clear()
    {
        $this->getAuth()->clearIdentity();
    }
    /*
     * Crea una corrispondenza tra i valori inseriti nei campi input
    della form (in questo caso username e password) e i valori
    dei campi della tabella.
    -Specifica che il canale di autenticazione è sul canale DB.
    -Parametri richiesti
     –L’attributo della tabella indicata associato all’identità (username
    dell’utente).
     –L’attributo della tabella indicata associato alle credenziali
    (password) dell’utente.
    Zend_Auth_Adapter_DbTable() crea una nuova istanza per l’autenticazione
    base DB, in cui i parametri sono:
     */
    private function getAuthAdapter($values)
    {
        
	$authAdapter = new Zend_Auth_Adapter_DbTable(
		Zend_Db_Table_Abstract::getDefaultAdapter(),
		'user',
		'username',
		'password'
	);
	$authAdapter->setIdentity($values['username']);
	$authAdapter->setCredential($values['password']);
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_logger->info('username:'.$values['username']);
        return $authAdapter;
    }
}
