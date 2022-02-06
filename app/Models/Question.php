<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
            'question',
            'category_id',
            'question_type_id',
            'question_mark'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function questionType(){
        return $this->belongsTo(QuestionType::class);
    }

    public function options(){
        return $this->hasMany(Option::class);
    }
    public function relationUsersQuestions(){
        return $this->hasMany(RelationUsersQuestion::class);
    }
}
