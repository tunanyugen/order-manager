<?php

class DB
{
    private mysqli $connection;
    public function __construct()
    {
        $this->connection = new mysqli(
            'db',
            'root',
            'root',
            'main'
        );
        // Check connection
        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }
    /**
     * Perform database insertion
     * @param string $sql
     * @param array $binds
     * @return void
     */
    public function insert(string $sql, array $binds = [])
    {
        $stmt = $this->prepare($sql, $binds);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . htmlspecialchars($stmt->error));
        }
        Logger::Log("New records created successfully.");
    }
    /**
     * Perform database selection
     * @param string $sql
     * @param array $binds
     * @return array
     */
    public function fetch(string $sql, array $binds = [])
    {
        $stmt = $this->prepare($sql, $binds);
        $stmt->execute();

        $result = $stmt->get_result();

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    /**
     * Prepare query
     * @param string $sql
     * @param array $binds
     * @return mysql_stmt
     */
    private function prepare(string $sql, array $binds = [])
    {
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . htmlspecialchars($this->connection->error));
        }
        if (!empty($binds)) {
            $types = str_repeat('s', count($binds));
            $stmt->bind_param($types, ...$binds);
        }
        return $stmt;
    }
    /**
     * Close database connection
     * @return void
     */
    public function close()
    {
        $this->connection->close();
    }
}
