<?php
namespace Bottin;
class Autoloader{



static function register(){
  spl_autoload_register(array( __CLASS__ , 'autoload'));
}



static function autoload($class) {
  $class = str_replace('Bottin\\', '', $class);
  $class = str_replace('\\', '/', $class);

    require   __DIR__ . '/' . $class . '.php';
  }
}



?>
