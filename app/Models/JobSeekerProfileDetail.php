<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeekerProfileDetail extends Model
{
    protected $fillable = ['user_id', 'education', 'experience', 'skills', 'cv_path'];

    protected function casts(): array
    {
        return [
            'education' => 'array',
            'experience' => 'array',
            'skills' => 'array',
        ];
    }
}
