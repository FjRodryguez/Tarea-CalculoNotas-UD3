<?php
use \TestClase\Daw2\Clases\Categoria;
use \TestClase\Daw2\Clases\Proveedor;
use \TestClase\Daw2\Clases\Producto;

require 'vendor/autoload.php';

$categoria = new Categoria("Electrónica");
$consolas = new Categoria("Consolas", $categoria);
$microsoft = new Categoria("Microsoft", $consolas);
$seriesx = new Categoria("Series X", $microsoft);
echo $categoria->getNombre();
echo "<br>";
echo $seriesx->getFullName();

$proveedor = new proveedor("A12345678", "123", "proveedor1", "España", "", "http://miproveedor.com", "proveedor@gmail.com", "666666666");

$producto = new producto(12345, "Producto 1", "", $proveedor, $categoria, 5.6, 50, 20, 21);

echo "<br>";
echo $producto->getStock();
echo "<br>";
echo $producto->descontarStock(2);
echo "<br>";
echo $producto->agregarStock(7);
echo "<br>";
echo $producto->getPrecioVenta();