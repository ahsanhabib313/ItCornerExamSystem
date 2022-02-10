<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['question_limit','pass_mark','category_id','mcq-ques_time', 'code_ques_time'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function questionType(){
        return $this->belongsTo(QuestionType::class);
    }
}
