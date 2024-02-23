<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use CrudTrait;
    protected $fillable = ['groupName', 'age', 'location_id'];
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function children()
    {
        return $this->belongsToMany(User::class, 'group_children')
            ->where('role_id', 1);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'group_teachers')
            ->where('role_id', 2);
    }
}
