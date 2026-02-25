<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
        ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getGenderTextAttribute(): string
    {
    return match ($this->gender) {
        1 => '男性',
        2 => '女性',
        3 => 'その他',
        default => '不明',
    };
    }

}
