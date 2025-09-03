<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','location','department','type','vacancies','application_deadline','skills','active'];
    protected $casts = ['skills' => 'array', 'application_deadline' => 'date'];

    public function applications() { return $this->hasMany(Application::class); }
}


class Application extends Model
{
    protected $fillable = ['job_id','name','email','phone','resume_path','cover_letter','status','meta'];
    protected $casts = ['meta' => 'array'];

    public function job() { return $this->belongsTo(Job::class); }
}
