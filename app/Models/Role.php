<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
