<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use App\Traits\Multitenantable;
use App\Models\MinistryUser;
use App\Models\InstitutionUser;
use App\Models\DepartmentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Hr\Entities\Comment;
use Modules\Hr\Entities\Company;
use Modules\Hr\Entities\Department;
use Modules\Hr\Entities\Employee;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ministryUser()
    {
        return $this->hasOne(MinistryUser::class, 'user_id', 'id');
    }
    public function institutionUser()
    {
        return $this->hasOne(InstitutionUser::class);
    }
    public function departmentUser()
    {
        return $this->hasOne(DepartmentUser::class);
    }
    public function unitUser()
    {
        return $this->hasOne(UnitUser::class);
    }
    public function municipalUser()
    {
        return $this->hasOne(MunicipalUser::class);
    }
    public function rdcUser()
    {
        return $this->hasOne(RDCUser::class);
    }

    public function projectQuestion()
    {
        return $this->hasOne(ProjectQuestion::class);
    }
}
