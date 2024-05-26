<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    protected $fillable = ['img_url','firstName','lastName','email','mobile','password','otp','status','role'];
    protected $attributes = ['otp' => '0'];
    protected $hidden = ['password', 'otp'];

    public static function getpermissionGroups(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    } // End Method


    public static function getpermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
            ->select('name','id')
            ->where('group_name',$group_name)
            ->get();
        return $permissions;

    }// End Method

    public static function roleHasPermissions($role, $permissions){

        $hasPermission = true;
        foreach($permissions as $permission){
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
            return $hasPermission;
        }

    }// End Method


}
