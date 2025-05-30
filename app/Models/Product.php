<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    //
    use HasTranslations;
    public $translatable = ['name', 'description'];
    protected $fillable = [
        'name',
        'description',
        'price',
        'has_discount',
        'discounted_price',
        'quantity',
        'status'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value == '1' ? 'active' : 'not active',
            set: fn (string $value) => $value == 'active' ? 1 : 0,
        );
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '1');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
