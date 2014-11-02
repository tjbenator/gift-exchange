<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Exchange extends Eloquent implements SluggableInterface
{
	use SluggableTrait;

	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

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
