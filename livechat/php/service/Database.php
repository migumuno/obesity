<?php

class Database extends Service
{
    // Constants
    
    const DEFAULT_PORT = 3306;
    
    // Fields
    
    private $db;
    
    // Constructor
    
    public function onRegister()
    {
        parent::onRegister();
        
        // -----
        
        $this->reconnect();
    }
    
    // Methods
    
    public function connect($dsn, $user, $pass)
    {
        $this->db = new PDO($dsn, $user, $pass);
    }

    public function reconnect()
    {
        $config     = $this->get('config');
        $installed  = isset($config->data['appSettings']['installed']) && $config->data['appSettings']['installed'];
        $connection = $installed ? $config->data['dbConnection'] : $config->data['dbConnectionRaw'];
        
        try
        {
            $this->connect($connection, $config->data['dbUser'], $config->data['dbPassword']);
        }
        catch(Exception $ex)
        {
            // Don't throw exceptions if application is not yet installed

            if($installed)
            {
                throw $ex;
            }
        }
    }
    
    public function execute($q, $params = null)
    {
        // Split all queries into separate ones
        
        $queries = $this->splitQueries($q);
        
        // Execute all queries and return the result of the last one
        
        try
        {
            foreach($queries as $q)
            {
                $statement = $this->db->prepare($q);

                if($statement)
                {
                    $result = $statement->execute($params);
                }
            }
            
            return $result;
        }
        catch(Exception $e)
        {
            return false;
        }
        
        return false;
    }
    
    public function query($q, $params = null)
    {
        // Split all queries into separate ones
        
        $queries = $this->splitQueries($q);
        
        // Execute all queries and return the result of the last one
        
        try
        {
            foreach($queries as $q)
            {
                $statement = $this->db->prepare($q);

                if($statement)
                {
                    $statement->execute($params);

                    $result = $statement->fetchAll();
                }
            }
            
            return $result;
        }
        catch(Exception $e)
        {
            return false;
        }
        
        return false;
    }
    
    public function queryOne($q, $params = null)
    {
        try
        {
            $statement = $this->db->prepare($q);
            
            if($statement)
            {
                $statement->execute($params);
                
                return $statement->fetch();
            }
        }
        catch(Exception $e)
        {
            return false;
        }
        
        return false;
    }
    
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function getTables()
    {
        $result = array();
        $tables = $this->query('SHOW TABLES');

        foreach($tables as $tableInfo)
        {
            $result[] = $tableInfo[0];
        }

        return $result;
    }
    
    protected function splitQueries($q)
    {
        return preg_split("/^\s*$/m", $q);
    }
}

?>
