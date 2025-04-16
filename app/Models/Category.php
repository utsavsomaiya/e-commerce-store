<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * @use HasFactory<CategoryFactory>
     */
    use HasFactory;

    public function categories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_category_id')
            ->select('id', 'name', 'parent_category_id');
    }

    public function children(): HasMany
    {
        return $this->categories()->with(__FUNCTION__);
    }
}
