<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_id',
        'uuid',
        'name',
        'email',
        'url',
        'image',
    ];

    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }

    public function getCompanies(string $filter = '')
    {
        $companies = $this->with('category')
                            ->where(function ($query) use ($filter) {
                                if ($filter != '') {
                                    $query->where('name', 'LIKE', "%{$filter}%");
                                    $query->orWhere('email', '=', $filter);
                                }
                            })
                            ->paginate();

        return $companies;
    }
}
