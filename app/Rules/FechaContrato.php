<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Datetime;

class FechaContrato implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $contratacion = new DateTime($value);
        $hoy = new DateTime();
        $fund = new DateTime('2022-07-09');

        if($contratacion <= $hoy){
            return;
        }
        elseif ($contratacion < $fund) {
            $fail('La fecha de contratación no es válida.');
        }
        else{
            $fail('La fecha de contratación no puede ser una fecha superior a la fecha actual');
        }

    }
}
