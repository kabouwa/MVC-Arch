<?php
class StudentDB{
    private $conn;
    private $tableName;
    private $idColName;
    public function __construct(PDO $conn,string $tableName = "Student", string $idColName = "idStud",){
        $this->conn = $conn;
        $this->tableName = $tableName;
        $this->idColName = $idColName;
    }
    public function getAll(string $orderBy = "", bool $desc = false){
        $query = "SELECT * FROM {$this->tableName} ";
        if(strlen($orderBy)>0){
            $query .= "ORDER BY {$orderBy} " . ($desc ? "DESC" : "ASC");
        }
        $cursor = $this->conn->query($query);
        $result = $cursor->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get(int $id){
        $query = "SELECT * FROM {$this->tableName} WHERE {$this->idColName} = ?";
        $cursor = $this->conn->prepare($query);
        $cursor->execute([$id]);
        $result = $cursor->fetch();
        return empty($result)?false:$result;
    }
    public function create(array $data){
        unset($data[$this->idColName]);
        $columns = [];
        $values = [];
        $placeHolders = [];
        foreach($data as $col => $val){
            $columns[] = $col;
            $values[] = $val;
            $placeHolders[] = "?";
        }
        $query = "INSERT INTO {$this->tableName} (". implode(",",$columns) . ") VALUES "
                ."(" . implode(",",$placeHolders) . ")" ;
        $cursor = $this->conn->prepare($query);
        $cursor->execute($values);
        return ($cursor->rowCount()>0)?$this->conn->lastInsertId():false;
        
    }
    public function update(int $id, array $modification){
        $values = [];
        $parts  = [];
        foreach($modification as $col => $val){
            $parts[] = "$col = ?";
            $values[] = $val;
        }
        $values[] = $id;
        $query = "UPDATE {$this->tableName} 
                SET " . implode(", ",$parts).
              " WHERE {$this->idColName} = ?";
        $cursor = $this->conn->prepare($query);
        $cursor->execute($values);
        return ($cursor->rowCount() > 0) ? true : false ;
    }
    public function delete(int $id){
        $query = "DELETE FROM {$this->tableName} WHERE {$this->idColName} = ?";
        $cursor = $this->conn->prepare($query);
        $cursor->execute([$id]);
        return ($cursor->rowCount() > 0) ? true : false ;
    }
    //More utilities
    public function isExist(array $data) : bool{
        $values = [];
        $parts = [];
        foreach($data as $col => $val){
            $parts[] = "LOWER($col) = LOWER(?)";
            $values[] = $val;
        }
        $query = "SELECT 1 FROM {$this->tableName}
                WHERE " . implode(" AND ",$parts) . 
                " LIMIT 1";
        $cursor = $this->conn->prepare($query);
        $cursor->execute($values);
        return (bool) $cursor->fetch() !== false;
    }
}
?>