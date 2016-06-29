<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag','title','subtitle','page_image','meta_description','reverse_direction',
    ];

    /**
     * 文章与标签之间多对多关联关系
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post','post_tag_pivot');
    }

    /**
     * 添加多条tag
     * @param array $tags
     */
    public static function addNeededTags(array $tags)
    {
        if (count($tags) === 0) {
            return;
        }
        $found = static::whereIn('tag',$tags)->lists('tag')->all();

        foreach (array_diff($tags,$found) as $tag) {
            static::create([
                'tag' => $tag,
                'title' => $tag,
                'subtitle' => 'Subtitle for '.$tag,
                'page_image' => '',
                'meta_description' => '',
                'reverse_direction' => false,
            ]);
        }
    }
}
