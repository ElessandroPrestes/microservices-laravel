<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $table = "heroes";

    protected $fillable = ['name', 'alias', 'power', 'url'];

    public $timestamps = true;

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
