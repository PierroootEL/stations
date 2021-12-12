<?php

    namespace stations\database;

    class Database
    {
        /** Private const */
        private const CRED_PATH = '/stations/assets/cred/db_cred.json';
        private const DB_DSN = 'mysql:host=localhost;dbname=stations;charset=utf8';

        private array $_DB_OPTIONS = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        /** Private variable */
        private $_username;
        private $_password;
        private $_dbh;

        public function __construct()
        {
            $this->_username = json_decode(file_get_contents(CRED_PATH), true)['db_user'];
            $this->_password = json_decode(file_get_contents(CRED_PATH), true)['db_pass'];
            $this->_dbh = new \PDO(self::DB_DSN, $this->_username, $this->_password, $this->_DB_OPTIONS);
        }

        public function databaseRequest(string $sql_req, array $sql_params = null): PDOStatement{
            $r = $this->_dbh->prepare($sql_req);
            $r->execute($sql_params);

            return $r;
        }

    }

?>