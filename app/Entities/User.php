<?php
declare(strict_types=1);

namespace App\Entities;

use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UsersRole::class, 'role_id');
    }
    
    /**
     * @return bool
     */
    public function isCitizen()
    {
        if (Auth::user()->role->slug === 'citizen') {
            return true;
        }
        
        return false;
    }
    
    /**
     * @return bool
     */
    public function isLawyer()
    {
        if (Auth::user()->role->slug === 'lawyer') {
            return true;
        }
        
        return false;
    }
    
}
