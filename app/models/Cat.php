<?php

class Cat extends Model{
    public $table = 'b_cat';

    public function classname(){
        return get_class($this);
    }

    public function allCat(){
        $query = $this->pdo()->prepare("SELECT b_cat.id, b_cat.name, count(b_cap.id) as count FROM b_cat LEFT JOIN b_cap ON b_cat.id = b_cap.c_id GROUP BY b_cat.id");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

    public function catByBlock($b_id){
        $query = $this->pdo()->prepare("SELECT b_cat.id, b_cat.name, b_cap.b_id, count(b_cap.id) as count FROM b_cat LEFT JOIN b_cap ON b_cat.id = b_cap.c_id WHERE b_cap.b_id = ? GROUP BY b_cat.id");
        $query->bindValue(1, $b_id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }
}