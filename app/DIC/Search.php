<?php
namespace Bottin\DIC;
require 'SmithWatermanGotoh.php';

class Search {

  Private $xml; //xml is a simple xml load easy to manipulate.
  Public $nodeNumberStock;

  function __construct($xml) {
   $this->xml = $xml;
  }
  /*
  **@var $nodeName give to the function the node where value need to match with research
  **@var $DataLookingFor
  */

  private function Compare($name, $name1)
  {


        $y = new SmithWatermanGotoh();
        $t= strval(strtolower($name1));
        $y= $y->compare(strval(strtolower($name)), $t);
        if ($y == 1) {
          return $y;
        }
   }

/**
* getNodeNumber return an array with all node value to access a person on the xml file
* @param string $nodeName is the $node path where we search value, the variable need to be writen in xpath with /
* @param string $dataLookingFor is a input of what we looking for in the specified $nodeName
* @param boolean $stock specify if you want to stock the nodeNumber under the class and call all element or just want the data for the call
* @return an array of nodenumber find for each $nodeName with contain the $dataLookingFor
 **/

  function getNodeNumber($nodeName, $dataLookingFor, $stock = FALSE) {
    $xml = $this->xml; //array
    for ($i=0;$i<count($xml); $i++){
      $nodeNameValues = $xml->person[$i]->xpath($nodeName);
        foreach($nodeNameValues as $nodeNameValue){
          $comparaison = self::Compare($nodeNameValue, $dataLookingFor);
            if ($comparaison == 1) {
              if($stock) {
                $this->nodeNumberStock []= $i;
              }
              else {
                $nodeNumbers[] = $i;
              }
            }
        }
    }
    if(isset($nodeNumbers) OR isset($this->nodeNumberStock)){
      if(!empty($nodeNumbers) OR !empty($this->nodeNumberStock)){
        if($stock) {
          return array_unique($this->nodeNumberStock);
        }
        else {
          return array_unique($nodeNumbers); //arrthis->ay with all node value of matching elements.
        }
      }
      else
      {
        return "Information not found.";
      }
    }
    else
    {
      return "error";
    }
  }



}





 ?>
