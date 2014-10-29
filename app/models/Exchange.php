<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Exchange extends Eloquent implements SluggableInterface
{
	use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

	protected $table = 'exchanges';
	
	public function getDrawAtAttribute($attr) {        
    	return date('F jS', $attr);
    }
	public function creator()
	{
		return $this->belongsTo('User', 'creator', 'id');
	}

	public function participants()
	{
		return $this->belongsToMany('User');
	}

}
