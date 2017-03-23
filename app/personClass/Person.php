<?php
namespace Bottin\personClass;

class Person{

  public $name;
  public $sim;
  public $email;
  public $dob;
  public $office;
  public $phoneext;

  public $onames = [];
  public $oprojects = [];
  public $osupervisors = [];
  public $osupervisors1 = [];
  public $ostarts = [];
  public $oends = [];

  public $gnames = [];
  public $gstarts = [];
  public $gends = [];


  function __construct($x)
  {
  //genrales informations
    //var_dump($x);
    $this->name = isset($x['name']) ? $x['name'] : " " ;
    $this->sim = isset($x['sim']) ? $x['sim'] : " " ;
    $this->email = isset($x['email']) ? $x['email'] : " " ;
    $this->dob = isset($x['dob']) ? $x['dob'] : " " ;
    $this->office = isset($x['office']) ? $x['office'] : " " ;
    $this->phoneext = isset($x['phoneext']) ? $x['phoneext'] : " " ;

  //occupation informations
if (isset($x['oname'])){
    foreach ($x['oname'] as $oname)
    {
      $this->onames[] = isset($oname) ? $oname : " ";
    }
}

if (isset($x['oproject'])) {
    foreach ($x['oproject'] as $oproject)
    {
      $this->oprojects[] = isset($oproject) ? $oproject : " ";
    }
}
if (isset($x['osuper'])) {
    foreach ($x['osuper'] as $osupervisor)
    {
      $this->osupervisors[] = isset($osupervisor) ? $osupervisor : " ";
    }
}
   if (isset($x['osuper1'])) {
    foreach ($x['osuper1'] as $osupervisor1)
    {
      $this->osupervisors1[] = isset($osupervisor1) ? $osupervisor1  : " ";
    }
  }
if (isset($x['ostart'])) {
    foreach ($x['ostart'] as $ostart)
    {
      $this->ostarts[] = isset($ostart) ? $ostart : " ";
    }
}
if (isset($x['oend'])) {
    foreach ($x['oend'] as $oend)
    {
      $this->oends[] = isset($oend) ? $oend : " ";
    }
}
   //groupe informations
if (isset($x['gname'])) {
  foreach ($x['gname'] as $gname)
  {
    $this->gnames[] = isset($gname) ? $gname : " ";
  }
}
if (isset($x['gstart'])) {
  foreach ($x['gstart'] as $gstart)
  {
    $this->gstarts[] = isset($gstart) ? $gstart : " ";
  }
}
if (isset($x['gend'])) {
  foreach ($x['gend'] as $gend)
  {
    $this->gends[] = isset($gend) ? $gend : " ";
  }
}
  }

public function addPerson($where) {
//var_dump($this->onames);
  error_reporting(0);
  $xml = new \DOMDocument('1.0');
  $xml->preserveWhiteSpace = false;
  $xml->formatOutput = TRUE;
  $xml = simplexml_load_file($where);


  $deb = $xml->addChild('person');
    $deb->addChild('sim', $this->sim);
    $deb->addChild('name', $this->name);
    $deb->addChild('email', $this->email);
    $deb->addChild('dob', $this->dob);
    $deb->addChild('office', $this->office);
    $deb->addChild('phoneext', $this->phoneext);

for($y=0; $y<count($this->onames); ++$y)
{
    $occ= $deb->addChild('occupation');
      isset($this->onames[$y]) ? $occ->addChild('name', $this->onames[$y]) : $occ->addChild('name', ' ') ;
      isset($this->oprojects[$y]) ? $occ->addChild('project', $this->oprojects[$y]) : $occ->addChild('project', ' ');
      isset($this->osupervisors[$y]) ? $occ->addChild('supervisor', $this->osupervisors[$y]) : $occ->addChild('supervisor', ' ') ;
      isset($this->osupervisors1[$y]) ? $occ->addChild('supervisor', $this->osupervisors1[$y]) : $occ->addChild('supervisor', ' ');
      isset($this->ostarts[$y]) ?  $occ->addChild('start', $this->ostarts[$y]) : $occ->addChild('start', ' ');
      isset($this->oends[$y]) ? $occ->addChild('end', $this->oends[$y]) : $occ->addChild('end', ' ') ;
}

for($i=0; $i<count($this->gnames); ++$i)
{
$grp = $deb->addChild('group');
  isset($this->gnames[$i]) ? $grp->addChild('name', $this->gnames[$i]) : $grp->addChild('name', ' ') ;
  isset($this->gstarts[$i]) ? $grp->addChild('start', $this->gstarts[$i]) : $grp->addChild('start', ' ');
  isset($this->gends[$i]) ? $grp->addChild('end', $this->gends[$i]) : $grp->addChild('end', ' ');

}

  $xml->asXML($where);

}


public function modifyPerson($where, $nodeNumber) {
  //error_reporting(0);
          $z=0;
          $u=0;
          $modi = array();

            $xml = new \DOMDocument('1.0');
            $xml->preserveWhiteSpace = false;
            $xml->formatOutput = TRUE;
            if(!file_exists($where)) {
              return false ;
            } else {
              $xml = simplexml_load_file($where) ;
            }

                    $people = $xml->person[$nodeNumber];
                    //var_dump($people);
                    //var_dump($this->name);


                    if ($people->name != $this->name) {
                          $r1 = !empty($this->name) ? $this->name : " " ;
                          //var_dump($r1);
                      $people->name = $r1;
                    }
                    elseif ($people->sim != $this->sim) {
                          $r2 = !empty($this->sim) ? $this->sim : " " ;
                      $people->sim = $r2;
                    }
                    elseif ($people->email != $this->email) {
                          $r3 = !empty($this->email) ? $this->email : " " ;
                      $people->email = $r3;
                    }
                    elseif ($people->dob != $this->dob) {
                          $r4 = !empty($this->dob) ? $this->dob : " " ;
                      $people->dob = $r4;
                    }
                    elseif ($people->office != $this->office) {
                          $r5 = !empty($this->office) ? $this->office : " " ;
                      $people->office = $r5;
                    }
                    elseif ($people->phoneext != $this->phoneext) {
                          $r6 = !empty($this->phoneext) ? $this->phoneext : " " ;
                      $people->phoneext = $r6;
                    }

                    $rxc = max(count($this->onames), count($this->oprojects), count($this->osupervisors), count($this->osupervisors1), count($this->ostarts), count($this->oends));
                    $rxd = count($people->occupation);
                    $rxd2 = $rxd -1;
                   //print_r($rxd);
                   $ocr = array();
                    for($mu=0; $mu<=$rxd2; $mu++) {
                          $occ = $people->occupation[$mu];

                          if (!isset($this->onames[$mu]) && !isset($this->oprojects[$mu]) && !isset($this->osupervisors[$mu]) && !isset($this->osupervisors1[$mu]) && !isset($this->ostarts[$mu]) && !isset($this->oends[$mu])) {
                                unset($people->occupation[$mu]);
                          }
                          else {
                          if ($occ->name != $this->onames[$mu]){
                                $mane = !empty($this->onames[$mu]) ? $this->onames[$mu] : " " ;
                                $occ->name =  $mane;
                            }

                          if ($occ->project != $this->oprojects[$mu]) {
                                $prorect = !empty($this->oprojects[$mu]) ? $this->oprojects[$mu] : " " ;
                                $occ->project = $prorect;
                          }
                          if ($occ->supervisor[$mu] != $this->osupervisors[$mu]) {
                                $pruv = !empty($this->osupervisors[$mu]) ? $this->osupervisors[$mu] : " " ;
                                $occ->supervisor[$mu] = $pruv;
                          }
                          $mr = $mu + 1;
                          if ($occ->supervisor[$mr] != $this->osupervisors1[$mu]) {
                                $pruv1 = !empty($this->osupervisors1[$mu]) ? $this->osupervisors1[$mu] : " " ;
                                $occ->supervisor[$mr] = $pruv1;
                          }
                          if ($occ->start != $this->ostarts[$mu]) {
                                $reat = !empty($this->ostarts[$mu]) ? $this->ostarts[$mu] : " " ;
                                $occ->start = $reat ;
                          }
                          if ($occ->end != $this->oends[$mu]) {
                              $rend = !empty($this->oends[$mu]) ? $this->oends[$mu] : " " ;
                              $occ->end = $rend;
                          }
                        }
                    }

                    if ($rxc - $rxd > 0) {
                    $upp1 = self::myNumber($rxc);
                    for($la = $upp1; $la < $rxc ; $la++) {
                        $occupation = $people->addChild('occupation');
                        $named = !empty($this->onames[$la]) ? $this->onames[$la] : " ";
                        $occupation->addChild('name', $named);
                        $projectd = !empty($this->oprojects[$la]) ? $this->oprojects[$la] : " ";
                        $occupation->addChild('project', $projectd);
                        $supervisord = !empty($this->osupervisors[$la]) ? $this->osupervisors[$la] : " ";
                        $occupation->addChild('supervisor', $supervisord );
                        $supervisord1 = !empty($this->osupervisors1[$la]) ? $this->osupervisors1[$la] : " ";
                        $occupation->addChild('supervisor', $supervisord1 );
                        $startd = !empty($this->ostarts[$la]) ? $this->ostarts[$la] : " ";
                        $occupation->addChild('start', $startd );
                        $endd = !empty($this->oends[$la]) ? $this->oends[$la] : " ";
                        $occupation->addChild('end', $endd );
                    }
              }


                    $rxe =  max(count($this->gnames), count($this->gstarts), count($this->gends));
                    $rxf = count($people->group);
                    $rxf2 = $rxf -1;

                    for($mz=0; $mz<=$rxf2; $mz++) {
                          $gro = $people->group[$mz];
                          if (!isset($this->gnames[$mz]) && !isset($this->gstarts[$mz]) && !isset($this->gends[$mz])) {
                                unset($people->group[$mz]);
                          }
                          else {

                          if ($gro->name != $this->gnames[$mz]) {
                                $x1 = !empty($this->gnames[$mz]) ? $this->gnames[$mz] : " " ;
                            $gro->name = $x1;
                          }
                          if ($gro->start != $this->gstarts[$mz]) {
                                $x2 = !empty($this->gstarts[$mz]) ? $this->gstarts[$mz] : " " ;
                              $gro->start = $x2;
                            }

                          if ($gro->end != $this->gends[$mz]) {
                                $x3 = !empty($this->gends[$mz]) ? $this->gends[$mz] : " " ;
                              $gro->end = $x3;
                            }
                      }
                    }
                    //print_r($this->gnames);
                    if ($rxe-$rxf > 0) {
                    $up = self::myNumber($rxe);
                      for($lb = $up; $lb < $rxe ; $lb++) {
                              $groupe = $people->addChild('group');
                              $nameg = !empty($this->gnames[$lb]) ? $this->gnames[$lb] : " " ;
                              //echo $nameg;
                              $groupe->addChild('name', $nameg );
                              $startg = !empty($this->gstarts[$lb]) ? $this->gstarts[$lb] : " " ;
                              $groupe->addChild('start', $startg );
                              $endg = !empty($this->gends[$lb]) ? $this->gends[$lb] : " " ;
                              $groupe->addChild('end', $endg );
                          }
                    }

                          $xml->asXML($where);

        //echo "Success";

self::__destruct();
      }

      private function myNumber($a) {
            if ($a == 1) {
                  return 1;
            }
            else {
                  $a -= 1;
                  return $a;
            }
      }


      public function __destruct()
      {
      //destruction

      unset($this->name) ;
      unset($this->sim );
      unset($this->email );
      unset($this->dob) ;
      unset($this->office) ;
      unset($this->phoneext) ;
      unset($this->oname) ;
      unset($this->oprojects);
      unset($this->osupervisors);
      unset($this->ostarts);
      unset($this->oends);
      unset($this->gnames);
      unset($this->gstarts);
      unset($this->gends);
      }





}












?>
