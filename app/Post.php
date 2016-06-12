<?php
//文章模型
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	*	文章发布时间
	**/
    protected $dates = ['published_at'];

    //设置slug
    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = $value;
    	if (!$this->exists) {
			$this->attributes['slug'] = str_slug($value);
    	}
    }
}
