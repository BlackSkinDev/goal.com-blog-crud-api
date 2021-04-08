<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{

    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
    	'source',
        'author',
        'title',
        'description',
        'url',
        'imageurl',
        'publishdate',
        'content'
    ];

    public function getImageurlAttribute($value){

        $imagePath= $this->getFirstMediaUrl() ? $this->getFirstMediaUrl() : $value;

        return $imagePath;

    }

    public function comments()
    {

        return $this->hasMany(Comment::class);
    }

}
