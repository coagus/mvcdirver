<?php
require_once 'db.php';

class Table {
    private $pdo;
    private $table;
    private $fields;
    private $values;
    private $where;
    private $update;
    
    public function __CONSTRUCT($table) {
        try {
            $strConnect  = 'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=' . CHARSET;
            $this->table = $table;
            $this->pdo   = new PDO($strConnect, USR, PWD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    private function fillFields($row) {
        $this->fields = "";
        $this->values = "";
        
        foreach ($row as $key => $value) {
            if ($value != '' && $key != 'id') {
                $this->fields .= $key . ',';
                $this->values .= "'" . $value . "',";
            }
        }
        
        $this->fields = substr($this->fields, 0, -1);
        $this->values = substr($this->values, 0, -1);
    }
    
    private function fillWhere($row) {
        $this->where = '';
        
        foreach ($row as $key => $value) {
            if ($value != '' && $value != null) {
                $this->where .= $key . "='" . $value . "' and ";
            }
        }
        
        $this->where = $this->where == '' ? '' : ' where ' . substr($this->where, 0, -4);
    }
    
    private function fillUpdate($row) {
        $this->update = '';
        
        foreach ($row as $key => $value) {
            if ($value != '' && $value != null && $key != 'Id') {
                $this->update .= $key . "='" . $value . "', ";
            }
        }
        
        $this->update = substr($this->update, 0, -2);
    }
    
    protected function createRow($row) {
        $this->fillFields($row);
        $qry = "INSERT INTO $this->table ($this->fields) VALUES ($this->values)";
        
        try {
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    public function getList($limit = "25") {
        try {
            $qry = "SELECT * FROM $this->table LIMIT $limit";
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
            
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    public function getById($Id) {
        try {
            $qry = "SELECT * FROM $this->table where Id = $Id";
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
            
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    protected function getRowsWhere($row) {
        $this->fillWhere($row);
        
        try {
            $qry = "SELECT * FROM $this->table $this->where";
            
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
            
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    protected function updateRow($row) {
        $this->fillUpdate($row);
        $Id = $row['Id'];
        
        try {
            $qry = "UPDATE $this->table SET $this->update where Id = $Id";
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    public function delete($Id) {
        try {
            $qry = "DELETE FROM $this->table WHERE Id = $Id";
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    public function getQuery($qry, $limit) {
        try {
            $qry = "$qry LIMIT $limit";
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
            
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    public function executeQry($qry) {
        try {
            $stm = $this->pdo->prepare($qry);
            $stm->execute();
        }
        catch (Exception $e) {
            die($e->getMessage() . '<br/>' . $qry);
        }
    }
    
    protected function saveData($id, $data) {
        if ($id == '') {
            $this->createRow($data);
        } else {
            $this->updateRow($data);
        }
    }
}
?>