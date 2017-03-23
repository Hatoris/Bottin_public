<?php
namespace Bottin\viewClass;



  class viewGroup{
    /**
    *
    * @var $xmlfile is a simple element xml
    * @var $nodenumber of people we want to view
    * @var $group name of group we are looking for
     **/
      Public $emailStock;

       static public function viewGroupPeople($xmlFile, $group){
         //error_reporting(0);
           $x = 'a';
           $a = 0;
        foreach($group as $groupName) {
           foreach($xmlFile->person as $v) {
              foreach ($v->group as $ux) {
                  if ($ux->name == $groupName)
                      {
                          $t = $ux->end;
                          $d = \Bottin\DIC\Date::stealWork($t);
                          if ($d == 1)
                          {
                              $format [] = '<span class="glyphicon glyphicon-ok" style="color:green"></span>';
                          }
                          else if ($d == 0)
                          {
                              $format [] = '<span class="glyphicon glyphicon-remove" style="color:red"></span>';
                          }
                          $name[] = $v->name;
                          $sim[] = $v->sim;
                          $email[] = $v ->email;
                          $start[] = $ux->start;
                          $end [] = $ux->end;
                      }
                     }
                  }
                  echo

                  '<div id="myAlert' . $x . $a . '" class="panel panel-info" target="' . $x . $a . '">
                         <div class="panel-heading">
                          <h5> <strong>' . " $groupName" . '</strong> <a id="linkClose"  href="#" class="close" target="' . $x . $a . '">&times;</a></h5>'.
                         '</div>

                         <div class="panel-body table-responsive">
                  <table class="table table-hover">
                         <thead>
                           <tr>
                             <th>Nom</th>
                             <th>SIM</th>
                             <th>Courriel</th>
                             <th>Debut</th>
                             <th>Fin</th>
                             <th style="text-align: center">Présent</th>
                           </tr>
                         </thead>
                         <tbody>';
              for ($i=0;$i<count($name);$i++) {

                  echo
                         '<tr>
                             <td>' . $name[$i] . '</td>
                             <td>' . $sim[$i] . '</td>
                             <td>' . $email[$i] . '</td>
                             <td>' . $start[$i] . '</td>
                             <td>' . $end[$i] . '</td>
                             <td style="text-align: center">' . $format[$i] . '</td>
                         </tr>';
              }
              echo '</tbody>
            </table>
            </div>
            </div>';
            $a++;
            unset($name);
            unset($sim);
            unset($email);
            unset($start);
            unset($end);
            unset($format);
            }
          }



        static public function getGroupName($xmlFile)
       {
         //$groupes = array();
          foreach($xmlFile->person as $person)
          {
            foreach ($person->group as $g)
            {
              $groupes []= $g->name;
            }
          }
          $groupes = array_unique($groupes);
          sort($groupes);
          return $groupes;
        }

        public function callPeopleByGroupEmail($xmlFile, $group, $stock = FALSE){
          $email = NULL;
          $groupNames = NULL;
          $groupe = NULL;
            error_reporting(0);
            $x = 'b';
            $a = 0;
            if($stock) {
              foreach($group as $groupName){
                foreach($xmlFile->person as $v)
               {
                   foreach ($v->group as $ux) {
                       if ($ux->name == $groupName)
                           {
                                        $t = $ux->end;
                                        $d = \Bottin\DIC\Date::stealWork($t);
                                        //var_dump($d);
                                        if ($d == 1)
                                        {
                                            $this->emailStock[]= $v->email;
                                            //$groupNames[] = $ux->name;
                                          }

                                        }
                                    }
                                   }
                                }

                echo

                '<div id="myAlert' . $x . $a . '" class="panel panel-info" target="' . $x . $a . '">
                       <div class="panel-heading">
                        <h5> <strong>' ;
                        //$groupNams = array_unique($groupNames);
                        foreach ($group as $groupNam) {
                          $groupe .= $groupNam . ', ' ;
                        }

                        echo
                        $groupe . ' Courriel</strong> <a id="linkClose"  href="#" class="close" target="' . $x . $a . '">&times;</a></h5>
                       </div>
                       <div class="panel-body" id="courriel' . $x . $a . '">';
                       if ($this->emailStock == null)
                        {
                            echo "Plus personne ne travail dans ce groupe";
                        }
                else {
                  $email = array_unique($this->emailStock);
                  $email = array_values($email);
            for ($i=0;$i<count($email);$i++) {

                echo $email[$i] . '; ' ;
            }
        }
            echo '
            </div>
            <div class="panel-footer">
            <button class="btn btn-info" data-clipboard-action="copy" data-clipboard-target="#courriel'. $x . $a . '"><span class="glyphicon glyphicon-copy"></span> Copier</button>
            </div>
            </div>
            ';
            $a++;
            unset($name);
            unset($sim);
            unset($email);
            unset($start);
            unset($end);
            unset($format);
              }
             else {
            foreach($group as $groupName){
            foreach($xmlFile->person as $v)
           {
               foreach ($v->group as $ux) {
                   if ($ux->name == $groupName)
                       {
                                    $t = $ux->end;
                                    $d = \Bottin\DIC\Date::stealWork($t);
                                    //var_dump($d);
                                    if ($d == 1)
                                    {
                                        $email[] = $v->email;
                                      }
                                    }
                                }
                               }

                            echo

                            '<div id="myAlert' . $x . $a . '" class="panel panel-info" target="' . $x . $a . '">
                                   <div class="panel-heading">
                                    <h5> <strong>' . " $groupName" . ' Courriel</strong> <a id="linkClose"  href="#" class="close" target="' . $x . $a . '">&times;</a></h5>
                                   </div>
                                   <div class="panel-body" id="courriel' . $x . $a . '">';
                                   if ($email == null)
                                    {
                                        echo "Plus personne ne travail dans ce groupe";
                                    }
                            else {
                        for ($i=0;$i<count($email);$i++) {

                            echo $email[$i] . '; ' ;
                        }
                    }
                        echo '
                        </div>
                        <div class="panel-footer">
                        <button class="btn btn-info" data-clipboard-action="copy" data-clipboard-target="#courriel'. $x . $a . '"><span class="glyphicon glyphicon-copy"></span> Copier</button>
                        </div>
                        </div>
                        ';
                        $a++;
                        unset($name);
                        unset($sim);
                        unset($email);
                        unset($start);
                        unset($end);
                        unset($format);

                    }
                  }
                  }










  }



 ?>
