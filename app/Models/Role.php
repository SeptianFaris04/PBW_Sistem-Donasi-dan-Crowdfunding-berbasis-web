<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Role extends SpatieRole
{
    // protected $table = 'roles';

    // protected $fillable = ['name', 'guard_name'];

    // public function permissions():BelongsToMany{
    //     return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    // }

    // public function users():BelongsToMany{
    //     return $this->morphedByMany(User::class, 'model', 'model_has_roles', 'role_id', 'model_id');
    // }
}
