<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "crypto_posts";
    protected $primaryKey = "id";
    protected $fillable = ['category_id', 'title', 'content', 'published_at'];
    protected $dates = ['published_at'];

    public const CREATE_RULES = [
        'category_id' => 'required',
        'title' => 'required|min:2',
        'content' => 'required',
        'published_at' => 'date',
    ];

    public const CREATE_MESSAGES = [
        'category_id.required' => 'Debes seleccionar una categoría.',
        'title.required' => 'El título no puede estar vacío.',
        'title.min' => 'El título debe tener al menos :min caracteres.',
        'content.required' => 'El contenido no puede estar vacío.',
        'published_at.date' => 'La fecha de publicación debe ser una fecha válida.',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
        ];
    }
}
