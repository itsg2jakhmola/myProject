<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Mail;
use App\Notification;

trait NotificationTrait
{
  /**
   * Function used to get Email on each or require event.

   * @param  [type] character        [to]
   * @param  [type] character        [subject]
   * @param  [type] character        [Message]
   * @return [type] boolean          [true]
   */

    protected $_notification_sender_id;
    protected $_receiver_id;
    protected $_receiver_type;
    protected $_sender_type;
    protected $_object;
    protected $_verb;
    protected $_message;
    protected $_meta_type;
    
    public function pushNotification($receiver_id, $receiver_type, $sender_id, $sender_type, $object, $verb, $message, $meta_type){
            
            $this->_receiver_id = $receiver_id;
            $this->_receiver_type = $receiver_type;
            $this->_notification_sender_id = $sender_id;
            $this->_sender_type = $sender_type;
            $this->_object = $object;
            $this->_verb = $verb;
            $this->_message = $message;
            $this->_meta_type = $meta_type;

            Notification::create(array(
              'receiver_id' => $receiver_id,
              'receiver_type' => $receiver_type,
              'sender_id' => $sender_id,
              'sender_type' => $sender_type,
              'object' => $object,
              'verb' => $verb,
              'message' => $message,
              'metadata' => json_encode(array(
                'type' => $meta_type
              )),
            ));
            
    }

}
