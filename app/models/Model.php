<?php

class Model{

    public function pdo(){
        try{
	        return new PDO('mysql:host=localhost;dbname=collection','root','');
        }catch (PDOException $e){
            exit('Database error.');
        }
    }
    
    public function fetch($limit = null){
        $limit ? $limit = "LIMIT " . $limit[0] . ", " . $limit[1] : "";
        $query = $this->pdo()->prepare("SELECT * FROM {$this->table} ORDER BY id DESC " . $limit);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

    public function find($id){
        $query = $this->pdo()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $query->bindValue(1, $id);
        $query->execute();

        return $query->fetchObject($this->classname());
    }

    public function where($column, $data, $limit = null){
        $limit ? $limit = "LIMIT " . $limit[0] . ", " . $limit[1] : "";
        $query = $this->pdo()->prepare("SELECT * FROM {$this->table} WHERE {$column} = ? ORDER BY id DESC " . $limit);
        $query->bindValue(1, $data);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

    public function whereAnd($array, $limit = null){
        $limit ? $limit = "LIMIT " . $limit[0] . ", " . $limit[1] : "";
        $query = $this->pdo()->prepare("SELECT * FROM {$this->table} WHERE {$array[0][0]} = ? AND {$array[1][0]} = ?  ORDER BY id DESC " . $limit );
        $query->bindValue(1, $array[0][1]);
        $query->bindValue(2, $array[1][1]);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

    public function count(){
        return $this->pdo()->query("SELECT count(*) from {$this->table}")->fetchColumn();
    }

    public function countBy($column = null, $where = null){

        if(!$where){
            $query = $this->pdo()->prepare("SELECT {$column} as {$column}, count(*) as count FROM {$this->table} GROUP BY {$column}");
            $query->execute();

            $count = [];
            foreach ($query->fetchAll() as $one){
                $count[$one[$column]] = $one['count'];
            }
            return $count;
        }else{
            $query = $this->pdo()->prepare("SELECT count(*) as count FROM {$this->table} WHERE {$where[0]} = ?");
            $query->bindValue(1, $where[1]);
            $query->execute();

            return $query->fetchColumn();
        }

    }
}