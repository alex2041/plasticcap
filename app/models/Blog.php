<?

class Blog extends Model{
    public $table = 'b_blog';

    public function classname(){
        return get_class($this);
    }
}