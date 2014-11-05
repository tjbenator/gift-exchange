<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Exchange extends Eloquent implements SluggableInterface
{
	use SluggableTrait;

	use SoftDeletingTrait;

    protected $dates = ['deleted_at', 'draw_at', 'give_at'];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

	protected $table = 'exchanges';

	public function initiator()
	{
		return $this->belongsTo('User', 'creator', 'id');
	}

	public function participants()
	{
		return $this->belongsToMany('User');
	}

	public function surprises()
	{
		return $this->hasMany('Surprise');
	}

}
