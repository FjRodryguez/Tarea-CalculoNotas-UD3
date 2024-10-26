<?php

namespace TestClase\Daw2\Clases;

class Proveedor
{

    public function __construct(private string $cif, private string $codigo, private string $nombre, private string $pais, private ?string $direccion = null, private ?string $website = null,
    private ?string $email, private ?string $telefono = null)
    {
        if (!self::checkCIF($cif)) {
            throw new \InvalidArgumentException("El cif no es válido '$cif'");
        }
        if (!is_null($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email no es válido '$email'");
        }
        if (!is_null($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("La url insertada no es válida '$website'");
        }
        if (!is_null($telefono) && !preg_match('/[0-9]{9}/', $telefono)) {
            throw new \InvalidArgumentException("El teléfono insertado no es válido '$telefono'");
        }
    }

    private static function checkCIF(string $cif) : bool
    {
        return preg_match("/^[KPQS][0-9]{7}[A-Z]$/", $cif) || preg_match("/^[ABEH][0-9]{8}$/", $cif) || preg_match("/^[CDFGLMN][0-9]{7}[A-Z0-9]$/", $cif);
    }
}