<?php

class MyDatabase {

    const server = "localhost";
    const username = "WebDiP2018x044";
    const password = "admin_YskH";
    const db_name = "WebDiP2018x044";

    private $connection = null;
    private $myError = '';

    function connectToDB() {
        $this->connection = new mysqli(self::server, self::username, self::password, self::db_name);
        if ($this->connection->connect_errno) {
            echo "Error during connection: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->myError = $this->connection->connect_error;
        }
        $this->connection->set_charset("utf8");
        if ($this->connection->connect_errno) {
            echo "Error during connection: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->myError = $this->connection->connect_error;
        }
        return $this->connection;
    }

    function closeDB() {
        $this->connection->close();
    }

    function selectDB($query) {
        $result = $this->connection->query($query);
        if ($this->connection->connect_errno) {
            echo "Error on query: {$query} - " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->myError = $this->connection->connect_error;
        }
        if (!$result) {
            $result = null;
        }
        return $result;
    }

    function updateDB($query, $script = '') {
        $result = $this->connection->query($query);
        if ($this->connection->connect_errno) {
            echo "Error on query: {$query} - " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->myError = $this->connection->connect_error;
        } else {
            if ($script != '') {
                header("Location: $script");
            }
        }

        return $result;
    }
    
    function showMyErrorDB() {
        if ($this->myError != '') {
            return true;
        } else {
            return false;
        }
    }
    
}

?>