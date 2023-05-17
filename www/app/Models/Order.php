<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;
    // use Sluggable;

    protected $fillable = [
        'title',
        'content',
        'reward',
        'order_type',
        'category_id',
        'is_featured',
        'image',
        'target_id',
        'user_id',
        'hunter_id'
    ];

    public function getHunterReward()
    {
        return $this->reward - ($this->reward * $this->order_commission/100);
    }

    public static function uploadImage(Request $request, $image = null)
    {
        if($request->hasFile('image')){
            if($image){
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('image')->store("uploads/images/{$folder}");
        }
        return $image;
    }

    public function getImage()
    {
        if(!$this->image){
            return asset("images/no_img.jpg");
        }
        return asset("storage/{$this->image}");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function hunter()
    {
        return $this->belongsTo(User::class,'hunter_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class,'target_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'order_tag'
        );
    }

    // /**
    //  * Return the sluggable configuration array for this model.
    //  *
    //  * @return array
    //  */
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }

}
