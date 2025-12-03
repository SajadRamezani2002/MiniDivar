<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // <-- این خط را اضافه کنید

class Ad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads'; // <-- این خط بسیار مهم را اضافه کنید

    protected $fillable = [
        'title',
        'description',
        'price',
        'city',
        'status',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
