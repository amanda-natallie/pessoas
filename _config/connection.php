<?php

define('DB_NAME', 'pessoas');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

class Connection {
  private $connection;
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASSWORD;
  private $db = DB_NAME;
 
  public function __construct() {
    $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
  }
 
  public function query($sql) {
    return $this->connection->query($sql);
  }
}