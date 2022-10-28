<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Funcion extends Enum
{
    const Option1 = 'Funciones lineal';
    const Option2 = 'Funciones cuadrática';
    const Option3 = 'Funciones definida por intervalos';
    const Option4 = 'Funciones combinación de funciones';
    const Option5 = 'Funciones inversas';
}
