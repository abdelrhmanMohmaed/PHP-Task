<?php

namespace PHP_Task\Classes\Models; 
use PHP_Task\Classes\DB;

class Task extends DB
{
    public function __construct()
    {
        $this->table = "tasks";  
        $this->connect();  
    }

    public function selectAllWithUser($field, $user_id) 
    {
        $sql = "SELECT tasks.*, users.id as user_id, users.first_name, users.last_name
                FROM tasks 
                LEFT JOIN users ON tasks.user_id = users.id
                WHERE tasks.$field = $user_id" ;

        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}