<?php
namespace Bottin\xmlClass;

/**
* @var path to xml file used for the application
*/

class setXMLFile{

  public $pathtoxml;

  public function __construct($pathtoxml) {
    $this->pathtoxml = $pathtoxml;
  }

  public function read() {
    $xmlFile = $this->pathtoxml;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"$xmlFile");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $contenu = curl_exec($curl);
    $xml = simplexml_load_string($contenu,null,true);
    return $xml;
  }

  public function file() {
    $xmlfilex = explode( "/" , $this->pathtoxml);
    return $xmlFile = end($xmlfilex);
  }

  public function reformatAndSave()
  {
    $xmlfilex = explode( "/" , $this->pathtoxml);
    $xmlFile = end($xmlfilex);

    if(!file_exists($xmlFile)) {
      return false ;
    } else
    {
      $dom = new \DOMDocument('1.0');
      $dom->preserveWhiteSpace = false;
      $dom->formatOutput = true;
      $dl = @$dom->load($xmlFile); // remove error control operator (@) to print any error message generated while loading.
      if ( !$dl ) die('Error when saving the document: ' . $xmlFile);
      $dom->save($xmlFile);
    }
  }





}




?>
