<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DniCliente implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dat = substr($value, 0, 4);
        $dni = intval($dat);

        if($dni >= 101 && $dni <= 108){
            return;
        }
        elseif($dni >= 201 && $dni <= 210){
            return;
        }
        else if($dni >= 301 && $dni <= 321){
            return;
        }
        else if($dni >= 401 && $dni <= 423){
            return;
        }
        else if($dni >= 501 && $dni <= 512){
            return;
        }
        else if($dni >= 601 && $dni <= 616){
            return;
        }
        else if($dni >= 701 && $dni <= 719){
            return;
        }
        else if($dni >= 801 && $dni <= 828){
            return;
        }
        else if($dni >= 901 && $dni <= 906){
            return;
        }
        else if($dni >= 1001 && $dni <= 1017){
            return;
        }
        else if($dni >= 1101 && $dni <= 1104){
            return;
        }
        else if($dni >= 1201 && $dni <= 1219){
            return;
        }
        else if($dni >= 1301 && $dni <= 1328){
            return;
        }
        else if($dni >= 1401 && $dni <= 1416){
            return;
        }
        else if($dni >= 1501 && $dni <= 1523){
            return;
        }
        else if($dni >= 1601 && $dni <= 1628){
            return;
        }
        else if($dni >= 1701 && $dni <= 1709){
            return;
        }
        else if($dni >= 1801 && $dni <= 1811){
            return;
        }
        else{
            $fail('Número de DNI no válido.');
        }
    }
}
