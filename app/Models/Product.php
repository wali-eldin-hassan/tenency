<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/store/{$this->category->slug}/{$this->slug}";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        if (strpos($this->attributes['image_path'], 'https:') === 0) {
            return $this->attributes['image_path'];
        }

        return '/' . $this->attributes['image_path'];
    }
}
