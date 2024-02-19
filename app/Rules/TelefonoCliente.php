<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TelefonoCliente implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $num = substr($value, 0, 1);
        $cel = intval($num);

        if($cel == 3){
            return;
        }
        elseif($cel == 8){
            return;
        }
        elseif($cel == 9){
            return;
        }
        elseif($cel == 2){
            return;
        }
        else{
            $fail('Número de telefono no válido.');
        }
    }
}
