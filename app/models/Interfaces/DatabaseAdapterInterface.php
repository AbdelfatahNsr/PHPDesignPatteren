<?php
    interface DatabaseAdapterInterface {
        public function getConnection(): \PDO;

        public function insert(string $table, array $data): bool;

        public function fetch($query, $params = []);

        public function update($table, $data, $conditions = []);

        public function getAllPersons();

    }
