<?php
namespace Bottin\DIC;
class Date {


  static public function lessYears ($originalDate)
    {
      setlocale (LC_TIME, 'fr_FR.utf8','fra');
      $newDate = strftime("%d %B", strtotime($originalDate));
      return "Le " . utf8_decode($newDate);

    }

  static public function stealWork($datetest)
    {
      setlocale (LC_TIME, 'fr_FR.utf8','fra');
      $today = date("Y-m-d");
      $date = date($datetest);
      if($date > $today or $date == null or $date == " " or !isset($date))
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }






}
















 ?>
