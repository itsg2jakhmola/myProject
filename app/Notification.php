<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Notification;
use Auth;

class Notification extends Model
{

     protected $fillable = [
      'receiver_id',
      'receiver_type',
      'sender_id',
      'sender_type',
      'object',
      'verb',
      'message',
      'metadata',
      'is_read',
      'created_at',
      'updated_at'
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'tbl_notifications';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['push_sent', 'sent_at', 'updated_at'];
    
    /**
	 * Get the foodie that belongs notification.
	 */
	public function patient($local_key = 'receiver_id')
    {
        return $this->belongsTo('App\User', $local_key, 'id');
    }
    
    /**
	 * Get the chef that belongs notification.
	 */
	public function doctor($local_key = 'sender_id')
    {
        return $this->belongsTo('App\User', $local_key, 'id');
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            //$uid = Auth::id();            
            $receiver_id = $model->receiver_id; // Extract receiver id from the last updated notification value;
            User::where('id', $receiver_id)->increment('notification_count');
        });
    }
}
