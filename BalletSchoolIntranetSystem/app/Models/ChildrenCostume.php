<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChildrenCostume extends Pivot
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = 'children_costumes';

    protected $fillable = ['assigned_at', 'costume_id', 'user_id'];

    public function children()
    {
        return $this->belongsToMany(User::class, 'children_costumes')
            ->where('role_id', 1);
    }
}





