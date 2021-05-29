<?php
class Telefones extends Connection
{
    private $table = 'tbl_telefones';

    public function getAll($withPersons = false)
    {


        $query = !$withPersons ? "SELECT * FROM $this->table" : "SELECT * FROM $this->table inner join tbl_pessoas on tbl_pessoas.p_id = $this->table.t_id_pessoa";

        $telefones = [];
        $result = parent::query($query);
        while ($record = $result->fetch_object()) {
            array_push($telefones, $record);
        }
        return $telefones;
    }
    public function getById($id)
    {
        return parent::query('SELECT * FROM ' . $this->table . ' inner join tbl_pessoas on tbl_pessoas.p_id = tbl_telefones.t_id_pessoa WHERE t_id = ' . $id)->fetch_assoc();
    }

    public function insert($params)
    {
        $sql = "INSERT INTO " . $this->table . "  (t_id_pessoa , t_numero, t_ddd, t_tipo) VALUES (" . $params[0] . ", '" . $params[1] . "', '" . $params[2] . "', '" . $params[3] . "')";
        return parent::query($sql);
    }

    public function update($id, $params)
    {
        $sql = "UPDATE " . $this->table . " SET t_id_pessoa=" . $params[0] . ", t_numero='" . $params[1] . "', t_ddd='" . $params[2] . "', t_tipo=" . $params[3] . " WHERE t_id=" . $id;
        return parent::query($sql);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM  " . $this->table . " WHERE t_id=" . $id;
        return parent::query($sql);
    }
}
