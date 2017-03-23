<?php


require 'Autoloader.php';
Bottin\Autoloader::register();

/**
* Set XML file path activate
* http://afam-udem.ca:81/people.xml;
* http://localhost/botin/Bottin/peopletest.xml
**/
$dic = new Bottin\DIC\DIContainer();
$dic->setFactory('Bottin\xmlClass\SetXMLFile', function (){
  return new Bottin\xmlClass\SetXMLFile("http://localhost/botin/app/people.xml");
});
$XML = $dic->get('Bottin\xmlClass\SetXMLFile');
$XMLFile = $XML->file();


/**
* Return PersonCard for nodenumber selected
* First call search application in factory to return a new search for each call, use XML path
*
**/
$dic->setFactory('Bottin\DIC\Search', function() use ($XML){
  return new Bottin\DIC\Search($XML->read());
});
$search = $dic->get('Bottin\DIC\Search');
$dic->setFactory('Bottin\viewClass\ViewPerson', function(){
  return new Bottin\viewClass\ViewPerson();
});
$ViewPerson = $dic->get('Bottin\viewClass\ViewPerson');
$dic->setFactory('Bottin\viewClass\ViewGroup', function(){
  return new Bottin\viewClass\ViewGroup();
});
$ViewGroup = $dic->get('Bottin\viewClass\ViewGroup');



if (isset($_POST['nameSearch'])){
  $dataLookingFor = $_POST['nameSearch'];
  $personNodeNumber1 = $search->getNodeNumber('name', $dataLookingFor, TRUE);
  $personNodeNumber2 = $search->getNodeNumber('sim', $dataLookingFor, TRUE);
  $personNodeNumber = $search->getNodeNumber('email', $dataLookingFor, TRUE);
  if(isset($personNodeNumber1) || isset($personNodeNumber2) || isset($personNodeNumber3)){
    $ViewPersonCard = $ViewPerson->ViewPersonCard($XML->read(), $personNodeNumber2);
    return $ViewPersonCard;
  }
}

if (isset($_POST['groupe'])){
  $groupe = $_POST['groupe'];
  $groupes = explode(",", $groupe);
  $ViewGroupPeople= $ViewGroup->ViewGroupPeople($XML->read(), $groupes);
  return $ViewGroupPeople;
}

if (isset($_POST['groupee'])){
  $groupe = $_POST['groupee'];
  $groupes = explode(",", $groupe);
  $callPeopleByGroupEmail = $ViewGroup->callPeopleByGroupEmail($XML->read(), $groupes);
  return $callPeopleByGroupEmail;
}


if (isset($_POST['groupeMerge'])){
  $groupe = $_POST['groupeMerge'];
  $groupes = explode(",", $groupe);
  $callPeopleByGroupEmail = $ViewGroup->callPeopleByGroupEmail($XML->read(), $groupes, TRUE);
  return $callPeopleByGroupEmail;
}


if (isset($_GET['getGroupName']) and $_GET['getGroupName'] === "getName"){
  $getGroupName = $ViewGroup->getGroupName($XML->read());
  echo json_encode($getGroupName);
}

// addPerson
if(isset($_POST['control'])) {
  if ($_POST['control'] === 'addPerson') {
    //var_dump($_POST);
    if (!isset($_POST['name'])){
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du nom</b>';
      echo json_encode($data);exit;
    }
    elseif (!isset($_POST['sim'])) {
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du numéro sim</b>';
      echo json_encode($data);exit;
    }
    elseif (!isset($_POST['email'])) {
      $data['status'] = 'errorInfos';
      $data['name'] = '<b>champ du courriel</b>';
      echo json_encode($data);exit;
    }
    else {
      $name = $_POST['name'] == " " ? NULL : $_POST['name'];
      $sim = $_POST['sim'] == " " ? NULL : $_POST['sim'];
      $email = $_POST['email'] == " " ? NULL : $_POST['email'];
      $personNodeNumber = $search->getNodeNumber('name', $name, TRUE);
      $personNodeNumber = $search->getNodeNumber('sim', $sim, TRUE);
      $personNodeNumber = $search->getNodeNumber('email', $email, TRUE);
      if($personNodeNumber != 'error'){
        $data['status'] = 'errorExist';
        $data['name'] = $_POST['name'];
        echo json_encode($data);exit;
      }
      else {
        $dic->setFactory('Bottin\personClass\Person', function() use ($_POST){
          return new Bottin\personClass\Person($_POST);
        });
        $addPerson = $dic->get('Bottin\personClass\Person');
        $addPerson->addPerson($XMLFile);
        $XML->reformatAndSave();
        $data['status'] = 'Success';
        $data['name'] = $_POST['name'];
        echo json_encode($data);exit;
      }
    }
  }
}

if (isset($_POST['nameSearchModify'])){
  $dataLookingFor = $_POST['nameSearchModify'];
  $personNodeNumber1 = $search->getNodeNumber('name', $dataLookingFor, TRUE);
  $personNodeNumber2 = $search->getNodeNumber('sim', $dataLookingFor, TRUE);
  $personNodeNumber = $search->getNodeNumber('email', $dataLookingFor, TRUE);
  if(isset($personNodeNumber1) || isset($personNodeNumber2) || isset($personNodeNumber3)){
    $ViewPersonModify = $ViewPerson->ViewPersonModify($XML->read(), $personNodeNumber);
    if (isset($ViewPersonModify)){
      return $ViewPersonModify;
    }
    elseif($personNodeNumber == 'error') {
      $error = '<div class="alert alert-danger" role="alert" id="modifyvx1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span><strong> ' . $dataLookingFor . '</strong> n\'a pas été trouvé dans la base de donnée ! <a id="linkClose"  href="#" class="close" target="vx1">&times;</a></div>';
      echo $error;
    }
  }
}


if(isset($_POST['control'])) {
  if ($_POST['control'] === 'modifyPerson') {
    $dic->setFactory('Bottin\personClass\Person', function() use ($_POST){
      return new Bottin\personClass\Person($_POST);
    });
    $modifyPerson = $dic->get('Bottin\personClass\Person');
    $name = $_POST['name'];
    $personNodeNumber = $search->getNodeNumber('name', $name);
    foreach ($personNodeNumber as $person) {
      $personNodeNumber = $person;
    }
    $add = $modifyPerson->modifyPerson($XMLFile, $personNodeNumber);
    $save = $XML->reformatAndSave();
      $data['status'] = 'Success';
      $data['name'] = $name;
      echo json_encode($data);exit;
    }
  }



?>
