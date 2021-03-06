<?php
namespace Bottin\DIC;

class DIContainer{

  private $registry = [];
  private $factories = [];
  private $instances = [];

//Return always the same instance
  public function set($key, Callable $resolver) {
    $this->registry[$key] = $resolver;
  }

//Return always a new instance
  public function setFactory($key, Callable $resolver) {
    $this->factories[$key] = $resolver;
  }

//initialise class
  public function setInstance($instance){
    $reflection = new \ReflectionClass($instance);
    //var_dump($reflection);
    $this->instances[$reflection->getName()] = $instance;
  }

  public function get($key){
    if(isset($this->factories[$key])) {
      return $this->factories[$key]();
    }
    if(!isset($this->instances[$key])) {
      if(isset($this->registry[$key])){
        $this->instances[$key] = $this->registry[$key]();
      } else {
        $reflected_class = new \ReflectionClass($key);
        if($reflected_class->isInstantiable()) {
          $constructor = $reflected_class->getConstructor();
          if($constructor) {
            $parameters = $constructor->getParameters();
            $constructor_parameters = [];
            foreach ($parameters as $parameter){
              if($parameter->getClass()){
              $constructor_parameters[] = $this->get($parameter->getClass()->getName());
              }
              else {
                $constructor_parameters[] = $parameter->getDefaultValue();
              }
            }
            $this->instances[$key] = $reflected_class->newInstanceArgs($constructor_parameters);
          } else {
            $this->instances[$key] = $reflected_class->newInstance();
          }
        } else {
            throw new Exception($key . " is not an instanciable class");
        }
      }

    }
    return $this->instances[$key];
  }

}




 ?>
