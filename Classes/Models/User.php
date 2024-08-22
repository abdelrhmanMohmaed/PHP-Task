<?php

namespace PHP_Task\Classes\Models;

use Exception;
use PHP_Task\Classes\DB;

class User extends DB
{
    public function __construct()
    {
        $this->table = "users";  
        $this->connect();  
    }

    public function searchByName($firstName, $lastName) {
        $query = "SELECT * FROM {$this->table} WHERE first_name LIKE ? AND last_name LIKE ?"; 
    
        $stmt = $this->connection->prepare($query);
        $firstName = "%$firstName%";
        $lastName = "%$lastName%";
        $stmt->bind_param('ss', $firstName, $lastName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}