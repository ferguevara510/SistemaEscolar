<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TipoUsuario extends Enum
{
    const Estudiante = 'Estudiante';
    const Profesor = 'Profesor';
    const Admin = 'Admin';
}
