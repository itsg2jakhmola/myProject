<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Mail;

trait GenerateToken
{
  /**
   * Function used to get Email on each or require event.

   * @param  [type] character        [to]
   * @param  [type] character        [subject]
   * @param  [type] character        [Message]
   * @return [type] boolean          [true]
   */

    public function generateRandomNumber($length = 10){
    
    $alphas = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $character =  implode('', $alphas);
    $charLength = strlen($character);

    $randomNumber = '';

    for( $i=0; $i<$length; $i++ ){
      $randomNumber .= $character[ rand( 0, $charLength-1 ) ];
    }

    return $randomNumber;
  }
   

}
