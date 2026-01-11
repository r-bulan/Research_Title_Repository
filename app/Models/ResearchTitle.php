<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchTitle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'author_name', 'email', 'category_id', 'photo'];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->author_name);
        $initials = '';
        foreach ($names as $name) {
            $initials .= strtoupper($name[0] ?? '');
        }
        return substr($initials, 0, 2) ?: 'N/A';
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }
}
