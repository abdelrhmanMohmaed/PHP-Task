<?php
namespace PHP_Task\Classes;

abstract class DB
{
    protected $connection;
    protected $table;

    public function connect()
    {
        $this->connection = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function login($authenticator, string $password, Session $session)
    {
        $sql = "SELECT users.*, 
                    departments.name as department_name, 
                    manager.first_name as manager_first_name, 
                    manager.last_name as manager_last_name
                FROM $this->table 
                LEFT JOIN departments ON users.department_id = departments.id
                LEFT JOIN users AS manager ON users.manager_id = manager.id
                WHERE users.email = ? OR users.phone = ?
                LIMIT 1";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $authenticator, $authenticator);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $session->set('id', $user['id']);
            $session->set('first_name', $user['first_name']);
            $session->set('last_name', $user['last_name']);
            $session->set('email', $user['email']);
            $session->set('phone', $user['phone']);
            $session->set('salary', $user['salary']);
            $session->set('avatar', $user['avatar']);
            $session->set('department_name', $user['department_name']);
            $session->set('department_id', $user['department_id']);

            
            $managerName = !empty($user['manager_first_name']) && !empty($user['manager_last_name']) 
                ? $user['manager_first_name'] . ' ' . $user['manager_last_name']
                : null;
            $session->set('manager_name', $managerName);

            if (empty($user['manager_id'])) {
                $teamSql = "SELECT id, first_name, last_name, email, phone 
                            FROM $this->table 
                            WHERE manager_id = ?";
                $teamStmt = mysqli_prepare($this->connection, $teamSql);
                mysqli_stmt_bind_param($teamStmt, 'i', $user['id']);
                mysqli_stmt_execute($teamStmt);
                $teamResult = mysqli_stmt_get_result($teamStmt);
                $teamMembers = mysqli_fetch_all($teamResult, MYSQLI_ASSOC);
                $session->set('team_members', $teamMembers);
            } else {
                $session->remove('team_members');
            }

            return true;
        }

        return false;
    }

    public function logOut(Session $session)
    {
        $session->remove('id');
        $session->remove('first_name');
        $session->remove('last_name');
        $session->remove('email');
        $session->remove('phone');
        $session->remove('salary');
        $session->remove('avatar');
    }

    public function isUniqueEmail($email, $excludeUserId = null)
    {
        $count = 0;
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        
        if ($excludeUserId !== null) {
            $query .= " AND id != ?";
        }

        $stmt = $this->connection->prepare($query);

        if ($excludeUserId !== null) {
            $stmt->bind_param('si', $email, $excludeUserId);
        } else {
            $stmt->bind_param('s', $email);
        }

        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count == 0;
    }

    

    public function selectAll(string $fields = "*"): array
    {
        $sql = "SELECT $fields FROM $this->table";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function selectId(Int $id, string $fields = '*')
    {
        $sql = "SELECT $fields FROM $this->table WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }
    public function selectWhere($condation, string $fields = "*"): array
    {
        $sql = "SELECT $fields FROM $this->table WHERE $condation";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getCount(): int
    {
        $sql = "SELECT COUNT(*) AS count FROM $this->table";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_assoc($result)["count"];
    }
    public function getCountWithCondation($condation): int
    {
        $sql = "SELECT COUNT(*) AS count FROM $this->table where $condation";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_assoc($result)["count"];
    }
    
    public function insert(string $fields, string $values)
    {
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        return mysqli_query($this->connection, $sql);
    }
    
    public function insertAndGetId(string $fields, string $values)
    {
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        mysqli_query($this->connection, $sql);
        return mysqli_insert_id($this->connection);
    }

    public function update(string $set, $id): bool
    {
        $sql = "UPDATE $this->table SET $set WHERE id = $id";
        // echo '<pre>';
        // echo $sql;
        // echo '<pre>';
        // die();
        return mysqli_query($this->connection, $sql);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);

        return mysqli_stmt_execute($stmt);
    }
}