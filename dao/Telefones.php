<?php
class Telefones extends Connection
{
    private $table = '`tbl_telefones`';

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
}
