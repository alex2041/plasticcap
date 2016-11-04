<?

class Link extends Model{
    public $table = 'b_link';

    public function classname(){
        return get_class($this);
    }
}