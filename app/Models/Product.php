<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'slug',
        'views',
        'shopee_url',
        'tokopedia_url',
        'active',
        'image'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['q'] ?? false, function ($query, $q) {
            $query->where('active', true)
                  ->where('name', 'LIKE', "%".$q."%")
                  ->orWhere('description', 'LIKE', "%".$q."%");
        });
        $query->when($filters['filter'] ?? false, function ($query, $filter) {
            switch ($filter) {
                case 'all':
                    $query->where('active', true)->orderBy('created_at', 'desc');
                    break;
                case 'new':
                    $query->where('active', true)->orderBy('id', 'desc');
                    break;
                case 'populer':
                    $query->where('active', true)->orderBy('views', 'desc');
                    break;
                case 'desc_harga':
                    $query->where('active', true)->orderBy('price', 'desc');
                    break;
                case 'asc_harga':
                    $query->where('active', true)->orderBy('price', 'asc');
                    break;
            }
        });
        $query->when($filters['cat'] ?? false, function ($query, $cat) {
            $query->where('active', true)->where('category_id', $cat);
        });
    }
}
