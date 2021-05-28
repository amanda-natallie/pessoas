<?php
class Pessoas extends Connection {
  private $table = '`tbl_pessoas`';
  
  public function getAll($telephone_id = null) {
    $query = "SELECT * FROM $this->table";

    if ($telephone_id) {
        $query .= "INNER JOIN tbl_telefones 
        ON tbl_telefones.t_id_pessoa = tbl_pessoas.p_id WHERE tbl_telefones.t_id = $telephone_id";
    } 
    $pessoas = [];
    $result = parent::query($query);
    while ($record = $result->fetch_object()) {
      array_push($pessoas, $record);
    }
    return $pessoas;
  }

  public function getById($id) {
    return parent::query('SELECT * FROM ' . $this->table . ' WHERE p_id = ' . $id)->fetch_object();
  }
}