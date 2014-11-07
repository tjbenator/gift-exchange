<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Exchange extends Eloquent implements SluggableInterface
{
	use SluggableTrait;

	use SoftDeletingTrait;

    protected $dates = ['deleted_at', 'draw_at', 'give_at'];
    protected $appends = array('draw_at_percentage', 'give_at_percentage');

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

	public function getDrawAtPercentageAttribute()
	{
		if ($this->draw_at->isPast()) return 100;
		$max = $this->created_at->diffInHours($this->draw_at);
		$now = $this->created_at->diffInHours();
		return $now / $max * 100;
	}


	public function getGiveAtPercentageAttribute()
	{
		if ($this->give_at->isPast()) return 100;
		$max = $this->created_at->diffInHours($this->give_at);
		$now = $this->created_at->diffInHours();
		return $now / $max * 100;
	}
}
