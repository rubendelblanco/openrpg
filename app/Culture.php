<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{   
    /**
     * The default category skills that has that culture
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsToMany('App\SkillCategory', 'culture_skill_category');
    }

    /**
     * The default skills that has that culture
     *
     * @return void
     */
    public function skills()
    {
        return $this->belongsToMany('App\Skill', 'culture_skill');
    }
}
