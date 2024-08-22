<?php

namespace PHP_Task\Classes\Models; 
use PHP_Task\Classes\DB;

class Department extends DB
{
    public function __construct()
    {
        $this->table = "departments";  
        $this->connect();  
    }

    public function searchByName(string $name)
    {
        $sql = "SELECT departments.name, COUNT(users.id) AS employee_count, SUM(users.salary) AS total_salary 
                FROM departments 
                LEFT JOIN users ON departments.id = users.department_id 
                WHERE departments.name LIKE '%$name%'
                GROUP BY departments.id";

        $result = mysqli_query($this->connection, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                'name' => $row['name'],
                'count' => $row['employee_count'],
                'salary' => $row['total_salary']
            ];
        }

        return $data;
    }
}