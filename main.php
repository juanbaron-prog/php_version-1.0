<?php

declare(strict_types=1);

require_once './clases/clases.php';
require_once './funciones/funciones.php';

while (true) {
    echo "\n==================================================\n";
    echo " SISTEMA DE LIQUIDACIÓN DE PERSONAL - ALCALDÍA\n";
    echo "==================================================\n\n";

    echo "Seleccione el tipo de vinculación a registrar:\n";
    echo "1. Funcionario de Planta\n";
    echo "2. Contratista\n";
    echo "3. Salir\n";
    
    $tipo = leer("Opción (1, 2 o 3): ");

    if ($tipo === '3') {
        echo "\nSaliendo del sistema... ¡Hasta luego!\n\n";
        break;
    }

    if ($tipo !== '1' && $tipo !== '2') {
        echo "\n Opción no válida. Intente nuevamente.\n";
        continue;
    }

    try {
        $tipoDoc = leer("Tipo de Documento (CC, CE, NIT): ");
        $numDoc = leer("Número de Documento: ");
        $nombres = leer("Nombres: ");
        $apellidos = leer("Apellidos: ");
        $correo = leer("Correo Electrónico: ");

        if ($tipo === '1') {
            $salarioBasico = (float)leer("Salario Básico Mensual ($): ");
            $diasTrabajados = (int)leer("Días Trabajados (1-30): ");

            $empleado = new Funcionario(
                $tipoDoc,
                $numDoc,
                $nombres,
                $apellidos,
                $correo,
                $salarioBasico,
                $diasTrabajados
            );
        } elseif ($tipo === '2') {
            $honorarios = (float)leer("Honorarios Mensuales ($): ");
            $retencion = (float)leer("Porcentaje Retención en la Fuente (%): ");

            $empleado = new Contratista(
                $tipoDoc,
                $numDoc,
                $nombres,
                $apellidos,
                $correo,
                $honorarios,
                $retencion
            );
        }

        echo "\n----------------------------------------\n";
        echo $empleado->informacion();
        echo "Neto a Pagar: $" . number_format($empleado->liquidarSalario(), 2) . "\n";
        echo "----------------------------------------\n";

    } catch (InvalidArgumentException $e) {
        echo "\n Error de validación: " . $e->getMessage() . "\n";
    } catch (Exception $e) {
        echo "\n Ocurrió un error inesperado: " . $e->getMessage() . "\n";
    }

    leer("\nPresione ENTER para continuar...");
}