<?php
require_once __DIR__."/../app/models/Interfaces/DatabaseAdapterInterface.php";
class PDODatabaseAdapter implements DatabaseAdapterInterface {
    protected $pdo;

    public function __construct(string $dsn, string $username, string $password, array $options = []) {
        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
            $this->pdo->exec('set names utf8');
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }

    public function insert(string $table, array $data): bool {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $statement = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        return $statement->execute();
    }

    public function fetch($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }
    public function getAllPersons() {
        $query = "SELECT * FROM person";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }
    public function update($table, $data, $conditions = []) {
        $sets = [];
        foreach ($data as $column => $value) {
            $sets[] = "$column = :$column";
        }

        $setClause = implode(', ', $sets);
        $whereClause = '';
        $params = [];

        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $column => $value) {
                $where[] = "$column = :cond_$column";
                $params[":cond_$column"] = $value;
            }
            $whereClause = " WHERE " . implode(' AND ', $where);
        }

        $query = "UPDATE $table SET $setClause $whereClause";

        $stmt = $this->pdo->prepare($query);
        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }
        $stmt->execute($params);

        return $stmt->rowCount();
    }


}
