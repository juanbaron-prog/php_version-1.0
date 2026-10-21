<?php

declare(strict_types=1);

/**
 * Función para leer datos desde la consola interactiva
 */
function leer(string $mensaje): string
{
    echo $mensaje;
    $resultado = readline();
    return trim($resultado !== false ? $resultado : '');
}