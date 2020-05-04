<?php
declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Аppointment.
 *
 * @package namespace App\Entities;
 */
class Аppointment extends Model implements Transformable
{
    use TransformableTrait;
    
    protected $table = 'аppointments';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'lawyer_id',
        'status_id',
        'time',
    ];
    
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * @return BelongsTo
     */
    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }
    
    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(AppointmentsStatus::class, 'status_id');
    }
    
}
