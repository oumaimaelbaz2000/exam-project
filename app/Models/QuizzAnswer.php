<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuizzAnswer
 *
 * @package App
 * @property string $question
 * @property string $option
 * @property tinyInteger $correct
*/
class QuizzAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'quizz_id', 'question_id', 'option_id', 'correct'];

    public static function boot()
    {
        parent::boot();

        
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
