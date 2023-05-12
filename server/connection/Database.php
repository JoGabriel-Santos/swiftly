<?php

    namespace sys4soft;

    use PDO;
    use PDOException;
    use stdClass;

    class Database
    {
        private string $_host;
        private string $_database;
        private string $_username;
        private string $_password;
        private int $_returnType;

        public function __construct(array $cfgOptions, string $returnType = 'object')
        {
            $this->_host = $cfgOptions['host'];
            $this->_database = $cfgOptions['database'];
            $this->_username = $cfgOptions['username'];
            $this->_password = $cfgOptions['password'];

            $this->_returnType = $returnType === 'object' ? PDO::FETCH_OBJ : PDO::FETCH_ASSOC;
        }

        public function executeQuery(string $sql, ?array $parameters = null): stdClass
        {
            $connection = new PDO(
                'mysql:host=' . $this->_host . ';dbname=' . $this->_database,
                $this->_username,
                $this->_password,
                [PDO::ATTR_PERSISTENT => true]
            );

            try {
                $statement = $connection->prepare($sql);
                $statement->execute($parameters);
                $results = $statement->fetchAll($this->_returnType);
                $count = $statement->rowCount();

            } catch (PDOException $e) {
                $results = null;
                $count = 0;
                $error = $e->getMessage();
                return $this->_result('error', $error, $sql, $results, $count, null);
            }

            $lastInsertId = null;
            $connection = null;

            return $this->_result('success', 'success', $sql, $results, $count, $lastInsertId);
        }

        public function executeNonQuery(string $sql, ?array $parameters = null): stdClass
        {
            $connection = new PDO(
                'mysql:host=' . $this->_host . ';dbname=' . $this->_database,
                $this->_username,
                $this->_password,
                [PDO::ATTR_PERSISTENT => true]
            );

            $connection->beginTransaction();

            try {
                $statement = $connection->prepare($sql);
                $statement->execute($parameters);
                $count = $statement->rowCount();
                $lastInsertId = $connection->lastInsertId();
                $connection->commit();

            } catch (PDOException $e) {
                $connection->rollBack();
                $count = 0;
                $lastInsertId = null;
                $error = $e->getMessage();
                return $this->_result('error', $error, $sql, null, $count, $lastInsertId);
            }

            $connection = null;

            return $this->_result('success', 'success', $sql, null, $count, $lastInsertId);
        }

        private function _result(string $status, string $message, string $sql, ?array $results, int $affectedRows, ?int $lastId): stdClass
        {
            $tmp = new stdClass();

            $tmp->status = $status;
            $tmp->message = $message;
            $tmp->query = $sql;
            $tmp->results = $results;
            $tmp->affectedRows = $affectedRows;
            $tmp->lastId = $lastId;

            return $tmp;
        }
    }
