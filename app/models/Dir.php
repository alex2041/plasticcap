<?

class Dir extends Model{
    public $table = 'b_dir';

    public function classname(){
        return get_class($this);
    }

    public function allDir(){
        $query = $this->pdo()->prepare("SELECT b_dir.id, b_dir.name, b_dir.c_id, count(b_cap.id) as count FROM b_dir LEFT JOIN b_cap ON b_dir.id = b_cap.d_id GROUP BY b_dir.id");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

    public function dirByBlock($b_id){
        $query = $this->pdo()->prepare("SELECT b_dir.id, b_dir.name, b_dir.c_id, count(b_cap.id) as count FROM b_dir LEFT JOIN b_cap ON b_dir.id = b_cap.d_id WHERE b_cap.b_id = ? GROUP BY b_dir.id");
        $query->bindValue(1, $b_id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, $this->classname());
    }

}