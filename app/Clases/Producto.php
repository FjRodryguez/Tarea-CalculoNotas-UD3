<?php

namespace TestClase\Daw2\Clases;

use MongoDB\Driver\Exception\InvalidArgumentException;
use TestClase\Daw2\Clases\Categoria;
use TestClase\Daw2\Clases\Proveedor;

class Producto{

    private const IVAS_VALIDOS = [0, 4, 10 ,21];
    private array $productosRelacionados;
    public function __construct(
        private string $codigo,
        private string $nombre,
        private string $descripcion,
        private Proveedor $proveedor,
        private Categoria $categoria,
        private float $coste,
        private float $margen,
        private int $stock = 0,
        private int $iva = 21
    ) {
        if (!preg_match(pattern: '/[\pL0-9]/iu', subject: $codigo)) {
            throw new InvalidArgumentException(message: 'El código debe contener al menos una letra o un número');
        }
        if (!preg_match(pattern: '/[\pL0-9]/iu', subject: $nombre)) {
            throw new InvalidArgumentException(message: 'El nombre debe contener al menos una letra o un número');
        }
        if ($coste <= 0) {
            throw new InvalidArgumentException(message: 'El coste debe debe ser mayor que cero');
        }
        if ($margen <= 0) {
            throw new InvalidArgumentException(message: 'El coste debe debe ser mayor que cero');
        }
        if ($stock < 0) {
            throw new InvalidArgumentException(message: 'El stock debe debe ser mayor o igual a cero');
        }
        if (!in_array(needle: $iva, haystack: self::IVAS_VALIDOS)) {
            throw new InvalidArgumentException(message: 'El IVA debe tener uno de los siguientes valores: ' . implode(separator: ', ', array: self::IVAS_VALIDOS));
        }
        $this->productosRelacionados = [];
    }

    public function getPrecioVenta(bool $conIva = true): float
    {
        $pvp = $this->coste * (1 + ($this->margen / 100));
        if ($conIva) {
            $pvp *= (1 + ($this->iva / 100));
        }
        return round($pvp, 2);
    }

    public function agregarArticulosRelacionados(Producto $p): void
    {
        $this->productosRelacionados[] = $p;
    }

    public function descontarStock(int $stock): int|bool
    {
        if ($stock <= 0) {
            throw new InvalidArgumentException('El stock a retirar debe ser mayor que cero');
        }
        if ($stock > $this->stock) {
            return false;
        }
        $this->stock -= $stock;
        return $this->stock;
    }

    public function agregarStock(int $stock): int
    {
        if ($stock <= 0) {
            throw new InvalidArgumentException('El stock a retirar debe ser mayor que cero');
        }
        $this->stock += $stock;
        return $this->stock;
    }
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getProveedor(): Proveedor
    {
        return $this->proveedor;
    }

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    public function getCoste(): float
    {
        return $this->coste;
    }

    public function getMargen(): float
    {
        return $this->margen;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getIva(): int
    {
        return $this->iva;
    }
}