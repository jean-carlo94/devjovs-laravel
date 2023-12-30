<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $casts = [ 'last_day'=>'datetime' ];

    protected $fillable = [
        'title',
        'wage_id',
        'category_id',
        'business',
        'last_day',
        'description',
        'image',
        'user_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function wage(){
        return $this->belongsTo(Wage::class);
    }

    public function candidates(){
        return $this->hasMany(Candidate::class)->orderBy('created_at', 'DESC');
    }

    public function recruiter(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
