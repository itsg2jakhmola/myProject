<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Mail;

trait EmailTrait
{
  /**
   * Function used to get Email on each or require event.

   * @param  [type] character        [to]
   * @param  [type] character        [subject]
   * @param  [type] character        [Message]
   * @return [type] boolean          [true]
   */

    protected $_fromAddress = 'notification@medcrip.com';
    protected $_fromName = 'MedCrip';
    protected $_to;
    protected $_subject;
    protected $_view;
    protected $_data = [];

    public function sendEmail($template, $data, $subject, $to, $from=""){
            $this->_view = $template;
            $this->_data = $data;
            $this->_subject = $subject;
            $this->_to = $to;
            $this->_fromName = 'notification@medcrip.com';
            Mail::send($this->_view, $this->_data, function($message){
              $message->from($this->_fromAddress, $this->_fromName)
                      ->to($this->_to)->subject($this->_subject);
            });
    }


    public function sendEmailToAdmin($template, $data, $subject, $to, $from=""){
            $this->_view = $template;
            $this->_data = $data;
            $this->_subject = $subject;
            $this->_to = "hello@medcrip.com";
            $this->_fromName = $from;
            Mail::send($this->_view, $this->_data, function($message){
              $message->from($this->_fromAddress, $this->_fromName)
                      ->to($this->_to)->subject($this->_subject);
            });
    }
}
