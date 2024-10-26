<?php

namespace TestClase\Daw2\Clases;

class Categoria{
    const SEPARADOR = ">";

    public function __construct(private string $nombre, private ?Categoria $padre = null){
        if(mb_strlen(trim($nombre)) === 0){
            new \InvalidArgumentException('El nombre de la categoría no puede estar vacio');
        }
    }

    public function getNombre() : string{
        return $this->nombre;
    }

    public function getPadre(): ?Categoria{
        return $this->padre;
    }

    public function getFullName() : string{
        $res = $this->nombre;
        $padre = $this->padre;

        while (!is_null($padre)){
            $res = $padre->nombre . self::SEPARADOR . $res;
            $padre = $padre->padre;
        }
        return $res;
    }
}