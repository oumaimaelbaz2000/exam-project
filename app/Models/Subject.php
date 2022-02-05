<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'subjects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'certificats_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
