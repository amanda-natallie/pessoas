<?php
class Pessoas extends Connection
{
  private $table = 'tbl_pessoas';

  public function getAll($telephone_id = null)
  {
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

  public function getById($id)
  {
    return parent::query('SELECT * FROM ' . $this->table . ' WHERE p_id = ' . $id)->fetch_assoc();
  }

  public function insert($params)
  {
    $sql = "INSERT INTO " . $this->table . " (p_nome, p_endereco) VALUES ('" . $params[0] . "', '" . $params[1] . "')";
    return parent::query($sql);
  }

  public function update($id, $params)
  {
    $sql = "UPDATE " . $this->table . " SET p_nome='" . $params[0] . "', p_endereco='" . $params[1] . "' WHERE p_id=" . $id;
    return parent::query($sql);
  }
  public function delete($id)
  {
    $sql = "DELETE FROM  " . $this->table . " WHERE p_id=" . $id;
    $sql1 = "DELETE FROM tbl_telefones WHERE t_id_pessoa =" . $id;
    parent::query($sql1);
    return parent::query($sql);
  }
}
