<?

class Block extends Model{
    public $table = 'b_block';

    public function classname(){
        return get_class($this);
    }
}