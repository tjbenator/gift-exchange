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
    	return date('F jS, Y', $attr);
    }

    public function getGiveAtAttribute($attr) {        
    	return date('F jS, Y', $attr);
    }

	public function creator()
	{
		return $this->belongsTo('User', 'creator', 'id');
	}

	public function participants()
	{
		return $this->belongsToMany('User');
	}

	public function rawDrawAt() {
		return $this->attributes['draw_at'];
	}

	public function rawGiveAt() {
		return $this->attributes['give_at'];
	}

	public function surprises()
	{
		return $this->hasMany('Surprise');
	}

}
