<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class quizz
 *
 * @package App
 * @property string $title
*/
class quizz extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'result'];

    public static function boot()
    {
        parent::boot();

        //quizz::observe(new \App\Observers\UserActionsObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function subjectsQuestions()
    {
        return $this->hasMany(Question::class, 'subjects_id', 'id');
    }

    public function certificats()
    {
        return $this->belongsTo(Certificat::class, 'certificats_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
