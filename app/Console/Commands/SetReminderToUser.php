<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\Traits\EmailTrait;
use App\DoctorPrescription;
use Auth;

class SetReminderToUser extends Command
{

    use EmailTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SetReminderToUser:sendreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Reminder to the users';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $auth = Auth::user();

        $appointmentReminder = DoctorPrescription::where('from_doctor', '35')->whereNotNull('set_reminder')->with('patient')->get();

        $subject = 'Reminder Email';
    
        $full_name = $appointmentReminder[0]['patient']['name'];
        $email = $appointmentReminder[0]['patient']['email'];
                
        foreach($appointmentReminder as $request){
            $sentEmail = $this->sendEmail('auth.emails.reminder_user', ["full_name" => $full_name, "notes" => $request['remarks']], $subject, $email, $this->_fromName);
                
                if($sentEmail) {
                    $status = DoctorPrescription::find($request['appointment_id']);

                }
            }

        }

}
