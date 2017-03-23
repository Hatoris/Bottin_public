<?php
namespace Bottin\viewClass;


class viewPerson {
/**
*
* @var $xmlfile is a simple element xml
* @var $nodenumber of people we want to view
 **/


  public function viewPersonCard($xmlFile, $nodeNumber = []) {
      error_reporting(0);
      $z=0;
        foreach($nodeNumber as $x) {
            $person = $xmlFile->person[$x];
                  $date = \Bottin\DIC\Date::lessYears($person->dob);
                  $date = utf8_encode($date);
                  echo

                  '<div id="myAlert' . $z .'" class="panel panel-info" target="' . $z . '">
                  <div class="panel-heading">
                   <h5> <strong>' . " {$person->name}" . '</strong> <a id="linkClose"  href="#" class="close" target="' . $z . '">&times;</a></h5>'.
                  '</div>
                  <div class="panel-body">
                  <div class="container">
                    <div class="row">
                      <h4><label>Informations generales</label></h4>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="row">
                          <label>Numero SIM :</label>' . " {$person->sim}" .
                        '</div>
                        <div class="row">
                          <label> Date de naissance: </label>' . " {$date}" .
                        '</div>
                        <div class="row">
                          <label>Courriel:</label>' . " {$person->email}" .
                        '</div>
                      </div>
                      <div class="col-md-4">
                        <div class="row">
                          <label>Numero de Bureau : </label>' . " {$person->office}" .
                        '</div>
                        <div class="row">
                          <label>Numero d\'extension du téléphone :</label>' . " {$person->phoneext}" .
                        '</div>
                      </div>
                      <div class="col-md-4">
                      </div>
                    </div>
                    <div class="row">
                    <h4><label>Occupation</label></h4>
                  </div>';

                  foreach ($person->occupation->supervisor as $sup) {
                  echo

                      '<div class="row">
                      <label>
                        Superviseur:
                      </label>' .
                       " {$sup}" .
                  '</div>';
                  }


              echo
                  '<div class="row">
                    <label>Fonction :</label>
                 </div>
                    <div class="col-sm-11" role="complementary">
                    <div class="panel-body table-responsive">
                        <table class="table table-striped">
                          <tr>
                        <th class="col-md-3">
                          Nom de la fonction
                        </th>
                        <th class="col-md-3">
                          Debut
                        </td>
                        <th class="col-md-3">
                          Fin
                        </th>
                      </tr>';


                      foreach ($person->occupation as $occ) {
                        echo
                        '<tr>
                            <td>' .
                             $occ->name .
                            "</td>
                            <td>" .
                              $occ->start .
                            "</td>
                            <td>" .
                                $occ->end .
                            '</td>
                        </tr>';
                        }
              echo
                  '</table> </div>
                  <div class="row">
                   <label>Projets :</label>
                   </div>

                  <div class="panel-body table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th class="col-md-3">
                        Nom du projet
                      </th>
                      <th class="col-md-3">
                        Debut
                      </td>
                      <th class="col-md-3">
                        Fin
                      </th>
                    </tr>';

                    foreach ($person->occupation as $projects) {
                        echo
                        "<tr>
                        <td>" .
                        $projects->project .
                      "</td>" .
                      "<td>" .
                        $projects->start .
                      "</td>" .
                      "<td>" .
                      $projects->end .
                      "</td>
                    </tr>";
                }
                echo
                  '</table>
                      </div>
                      <div class="row">
                        <h4>
                      <label>Groupe</label>
                        </h4>
                      </div>
                      <div class="panel-body table-responsive">
                          <table class="table table-striped">
                            <tr>
                          <th class="col-md-3">
                            Nom du groupe
                          </th>
                          <th class="col-md-3">
                            Debut
                          </td>
                          <th class="col-md-3">
                            Fin
                          </th>
                        </tr>';


                      foreach ($person->group as $groups) {
                      echo
                      '<tr>
                          <td>' .
                           $groups->name .
                          "</td>
                          <td>" .
                            $groups->start .
                          "</td>
                          <td>" .
                              $groups->end .
                          '</td>
                      </tr>';
                      }
                      echo
                  "</table>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>" ;

                  if ($x==0){
                      return 0;
                      /*
                      echo '<div class="alert alert-danger" role="alert"> <strong>' . $name . '</strong> , n\'existe pas dans we people of AFAM!</div>';
                      */
                  }
                  $z++;
              }
            }

              public function viewPersonModify($xmlFile, $nodeNumber = []) {
                    error_reporting(0);
                            $z=0;
                            $u=0;
                            $xc = 1;
                            $superm = array ();


                                  foreach($nodeNumber as $u) {
                                       $people = $xmlFile->person[$u];

                        echo
                            '
                                 <div class="panel panel-primary" target="' . $xc . '" tag="modify"'. $xc .'" id="modify'. $xc .'">
                                   <div class="panel-heading">
                                     <strong> Modifier un membre a l\'AFAM </strong>
                                     <a id="linkClose"  href="#" class="close" target="' . $xc . '">&times;</a>
                                   </div>
                                   <div class="panel-body" id="' . $xc . '">
                                     <form class="modifypeople' . $xc . '" action="" method="POST" id="' . $xc . '">
                                       <div class="form-group">
                                         <label for="name">Nom, prenom:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                           <input type="text" defaultvalue=" " class="form-control" name ="name" value="' . $people->name . '" id="name" placeholder="Nom, prenom">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="dob">Date de naissance:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                           <input type="text" defaultvalue=" " class="form-control date"  data-provide="datepicker" value="' . $people->dob . '" name ="dob" id="dob" placeholder="aaaa-mm-jj">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="sim">Numero SIM:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
                                           <input type="text" defaultvalue=" " class="form-control" name ="sim" value="' . $people->sim . '" id="sim" placeholder="SIM">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="email">Courriel:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon">@</span>
                                           <input type="email" defaultvalue=" " class="form-control" name ="email" value="' . $people->email . '" id="email" placeholder="xxxxx@umontreal.ca">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="office">Bureau N°:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                                           <input type="office" defaultvalue=" " class="form-control" name ="office" value="' . $people->office . '" id="office" placeholder="4179">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="phoneext">Extension téléphone N°:</label>
                                         <div class="input-group">
                                           <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                           <input type="phoneext" defaultvalue=" " class="form-control" value="' . $people->phoneext . '" name ="phoneext" id="phoneext" placeholder="0407">
                                         </div>
                                       </div>
                                       <h4><label for="name">Occupation</label></h4>
                                       <div class="input_fields_wrap_occupation_bis" id="'. $xc .'">
                                         <button class="btn btn-info add_field_button_bis" id="'. $xc .'">Ajouter une occupation</button>
                                         <div class="form-group" style="padding-top : 10px">
                                          <div class="table-responsive">
                                           <table class="table" id="occupationsbis'. $xc .'">' ;
                                           if (!isset($people->occupation)) {
                                             echo '<tr id="c'. 0 . '" class="occ">
                                              <td><label for="oname">Nom de l\'occupation:</label></br><input defaultvalue=" " type="text" value="" class="form-control" defaultvalue=" " id="oname" name="oname['. 0 . ']">  </td>
                                              <td><label for="oproject">Nom du projet:</label></br><input defaultvalue=" " type="text" value="" class="form-control" defaultvalue=" " id="oproject" name="oproject['. 0 . ']"></td>
                                              <td><table><td id="bb'. 0 .'"><label for="osuper">Nom du superviseur: </label><a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="'. 0 . '" style="align: center"></a></br><input defaultvalue=" " type="text" value="" class="form-control" defaultvalue=" " id="osuper" name="osuper[' . $c . ']"></td><table><tr id="g'. $c .'"><td><input type="text" class="form-control col-md-1 osup1" content="width=80%" defaultvalue=" " value="" id="" name="osuper1['. 0 . ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="'. 0 .'" style="align: center"></a></td></tr></table></td>
                                              <td><label for="ostart">Date de debut:</label></br><input defaultvalue=" " type="text" value="" class="form-control" defaultvalue=" " id="ostart" name="ostart['. 0 . ']"></td>
                                              <td><label for="oend">Date de fin:</label></br><input defaultvalue=" " type="text" value="" class="form-control" defaultvalue=" " id="oend" name="oend['. 0 . ']"></td>
                                             </tr>' ;

                                           } else {
                                             $c = 0 ;
                                             foreach ($people->occupation as $occ) {
                                              echo '<tr id="c'. $c . '" class="occ">
                                               <td><label for="oname">Nom de l\'occupation:</label></br><input defaultvalue=" " type="text" value="' . $occ->name . '" class="form-control" defaultvalue=" " id="oname" name="oname['. $c . ']">  </td>
                                               <td><label for="oproject">Nom du projet:</label></br><input defaultvalue=" " type="text" value="' . $occ->project . '" class="form-control" defaultvalue=" " id="oproject" name="oproject['. $c . ']"></td>
                                               <td><table><td id="bb'. $c .'"><label for="osuper">Nom du superviseur: </label><a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="'. $c . '" style="align: center"></a></br><input defaultvalue=" " type="text" value="' .  $occ->supervisor[0]  . '" class="form-control" defaultvalue=" " id="osuper" name="osuper[' . $c . ']"></td>';
                                               if (isset($occ->supervisor[1])) {
                                                 echo '<table><tr id="g'. $c .'"><td><input type="text" class="form-control col-md-1 osup1" content="width=80%" defaultvalue=" " value="' . $occ->supervisor[1]  . '" id="" name="osuper1[' . $c . ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="' . $c . '" style="align: center"></a></td></tr>';
                                               }
                                               echo '</table></td><td><label for="ostart">Date de debut:</label></br><input defaultvalue=" " type="text" value="' . $occ->start . '" class="form-control" defaultvalue=" " id="ostart" name="ostart['. $c . ']"></td>
                                               <td><label for="oend">Date de fin:</label></br><input defaultvalue=" " type="text" value="' . $occ->end . '" class="form-control" defaultvalue=" " id="oend" name="oend['. $c . ']"></td>' ;
                                               if ($c != 0) {
                                               echo '<td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' . $c . '" style="align: center"></a></td>' ;
                                             }
                                              echo '</tr>' ;
                                              $c++;
                                        }
                                           }


                                            echo '
                                           </table>
                                           </div>
                                         </div>
                                       </div>
                                       <h4><label for="name">Groupe</label></h4>
                                       <div class="input_fields_wrap_groupe_bis">
                                         <button class="btn btn-info add_field_button_groupe_bis" id="'. $xc .'">Ajouter un groupe</button>
                                         <div class="form-group" style="padding-top : 10px">
                                           <table class="table table-hover" id="groupesbis'. $xc .'">';
                                            if (!isset($people->group)) {
                                              echo '<tr id="d'. $d . '" class="gro">
                                                <td><label for="gname">Nom du groupe:</label></br><input type="text" defaultvalue=" " value="" class="form-control" defaultvalue=" " id="gname" name="gname[' . 0 . ']"> </td>
                                                <td><label for="gstart">Date de debut:</label></br><input type="text" defaultvalue=" " value="" class="form-control" defaultvalue=" " id="gstart" name="gstart[' . 0 . ']"></td>
                                                <td><label for="gend">Date de fin:</label></br><input type="text" defaultvalue=" " value="" class="form-control" defaultvalue=" " id="gend" name="gend[' . 0 . ']"></td>
                                              </tr>' ;
                                            } else {
                                           $d = 0 ;
                                           foreach ($people->group as $gro) {

                                             echo '<tr id="d'. $d . '" class="gro">
                                               <td><label for="gname">Nom du groupe:</label></br><input type="text" defaultvalue=" " value="' . $gro->name . '" class="form-control" defaultvalue=" " id="gname" name="gname[' . $d . ']"> </td>
                                               <td><label for="gstart">Date de debut:</label></br><input type="text" defaultvalue=" " value="' . $gro->start . '" class="form-control" defaultvalue=" " id="gstart" name="gstart[' . $d . ']"></td>
                                               <td><label for="gend">Date de fin:</label></br><input type="text" defaultvalue=" " value="' . $gro->end . '" class="form-control" defaultvalue=" " id="gend" name="gend[' . $d . ']"></td>';
                                               if ($d != 0) {
                                               echo '<td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' . $d . '" style="align: center"></a></td>' ;
                                             }
                                             echo '</tr>' ;
                                             $d++;
                                           }
                                       }
                                           echo '</table>
                                         </div>
                                       </div>
                                       <div>
                                         <button type="submit2" id="'. $xc .'" value="send" style="margin-top : 10px"class="btn btn-warning submit2"><span class="glyphicon glyphicon glyphicon-paste"></span> Modifier</button>
                                       </div>
                                       </form>
                                       <span class="results2" id="'. $xc .'">  <br>
                                       </span>
                                     </div>
                                   </div>' ;

                                   ++$xc;


                                      ++$u;
                                    }

                              }







}






 ?>
