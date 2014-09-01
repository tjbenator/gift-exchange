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


	public function creator() {
		return $this->belongsTo('User');
	}

	public function participants() {
		return $this->belongsToMany('User');
	}

}
