<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationUserQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','question_id','exam_id','examinee_answer','created_at', 'updated_at'];
}
