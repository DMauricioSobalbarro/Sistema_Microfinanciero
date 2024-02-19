<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use DateTime;

class MayorEdad implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fechaNacimiento = new DateTime($value);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;

        // Verificar si la fecha de nacimiento es mayor que la fecha actual
        if($fechaNacimiento > $hoy){
            $fail('La fecha de nacimiento no puede ser una fecha superior a la fecha actual');
        }
        elseif ($edad < 18 && $edad >= 0) {
            $fail('La fecha de nacimiento no es válida, el empleado debe ser mayor de 18 años.');
        }
        elseif($edad > 60){
            $fail('El empleado no puede ser mayor de 60 años');
        }
        else{
            return;
        }
    }
}
