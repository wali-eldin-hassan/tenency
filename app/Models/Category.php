<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->products()->get()->each->update(['category_id' => null]);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/store/{$this->slug}";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImagePathAttribute()
    {
        if (strpos($this->attributes['image_path'], 'https:') === 0) {
            return $this->attributes['image_path'];
        }

        return '/' . $this->attributes['image_path'];
    }
}
