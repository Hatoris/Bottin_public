$(document).ready(function() {
  /**
   * jQuery for add people
   */
  var groupeName = new Array;
  var selector = 'input#gname';
  var max_fields = 10; //maximum input boxes allowed
  var max_fileds_superviseur = 10;
  var wrapper_groupe = $(".input_fields_wrap_groupe"); //Fields wrapper
  var wrapper_occupation = $(".input_fields_wrap_occupation"); //Fields wrapper
  var add_occupation = $(".add_field_button_occupation"); //Add button ID
  var add_groupe = $(".add_field_button_groupe"); //Add button group
  var add_supp = $(".add_osup"); //Add supervasier
  var z = 1; // initial count
  var x = 1; //initlal text box count
  var s = 1;
  var y = 1; //initlal text box count


  jQuery.fn.extend({
    dataFind: function (control) {
      var findNameForm = $(this).find('[name]');
      var datas = {};
      datas['control'] = control;
      $.each(findNameForm, function() {
        if ($(this).val() == '') {
          var vals = $(this).attr('defaultvalue');
        } else {
          var vals = $(this).val();
        }
        var name = $(this).attr('name');
        datas[name] = vals;
      });
      return datas;
    }
  });

  $.getJSON("app/index.php", { getGroupName: "getName" }).done(function(result) {
    $.each(result, function() {
      var i = 0;
      groupeName.push(this[i]);
      i++;
    });
  });


  $("#dob, #ostart, #oend, #gstart, #gend").datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
  });

  $(document).on('keydown.autocomplete', selector, function() {
    $(this).autocomplete({
      source : groupeName,
      minLength : 1,

    });
  });

  $("#submit").click(function() {
    var datas =   $("form.addpeople").dataFind('addPerson');

    $.ajax({
      url: 'app/index.php',
      type: 'POST',
      data: datas,
      dataType: 'json',
      success: function(res) {
        if (res.status == 'Success') {
          $("#results").append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span><strong> ' + res.name + ' </strong> a bien été ajouté aux membres de l\'AFAM</div>');
          setTimeout(function() {
            $('.alert').remove();
          }, 2000);
          $("form.addpeople").trigger('reset');
        } else if (res.status == 'error') {
          $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span><strong> ' + res.name + ' </strong> </div>');
          setTimeout(function() {
            $('.alert').remove();
          }, 5000);
        } else if (res.status == 'errorInfos'){
          $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span> Vous n\'avez pas rempli le ' + res.name + ' </div>');
          setTimeout(function() {
            $('.alert').remove();
          }, 3000);
        } else if (res.status == 'errorExist'){
          $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span> <b> ' + res.name + ' </b> existe déja dans la base de donnée </div>');
          setTimeout(function() {
            $('.alert').remove();
          }, 3000);
        }
      },
      error: function(res){
        $("#results").append('<div>'+ res.responseText +'</div>');
      }
    });
    return false;
  });

  $(add_occupation).click(function() { //on add input button click

      if (x < max_fields) { //max input box allowed
          x++; //text box increment
          $("#occupations").append('<tr classe="' + x + '" id="a' + x + '"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" defaultvalue=" " id="oname" name="oname[' + x + ']"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" defaultvalue=" " id="oproject" name="oproject[' + x + ']"></td><td id ="aa' + x + '"><label for="osuper">Nom du superviseur:</label> <a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="' + x + '" style="align: center"></a></br><input type="text" class="form-control" defaultvalue=" " id="osuper" name="osuper[' + x + ']"></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="ostart" name="ostart[' + x + ']"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="oend" name="oend[' + x + ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field" id="' + x + '" style="align: center"></a></td></tr>'); //add input box
          z = 1;
      }
      $("#ostart, #oend").datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          autoclose: true,
      });
        return false;
  });

  $("#occupations").on("click", ".remove_field", function() { //user click on remove text
      $("#a" + $(this).attr("id")).remove();
      x--;
      s--;
      return false;
  })


  $(add_groupe).click(function() { //on add input button click
      if (y < max_fields) { //max input box allowed
          y++; //text box increment
          $("#groupes").append('<tr id="b' + y + '"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control gname" defaultvalue=" " id="gname" name="gname[' + y + ']"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="gstart" name="gstart[' + y + ']"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="gend" name="gend[' + y + ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe" id="' + y + '" style="align: center"></a></td></tr>'); //add input box
      }
      $("#gstart, #gend").datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          autoclose: true,
      });
      return false;
  });

  $("#groupes").on("click", ".remove_field_groupe", function() { //user click on remove text
      $("#b" + $(this).attr("id")).remove();
      y--;
      return false;
  })

  $("#occupations").on("click", ".add_osup", function() {
      if (z < max_fileds_superviseur) {
          z++;
          s++;
          $("#aa" + $(this).attr("id")).append('<tr id="g' + z + '"><td><input type="text" class="form-control col-md-1" content="width=80%" defaultvalue=" " id="' + z + '" name="osuper1[' + s + ']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="' + z + '" style="align: center"></a></td></tr>');
          //console.log($(this).attr("id"));
      }
      return false;
  });
  $("#occupations").on("click", ".remove_osup", function() { //user click on remove text
      $("#g" + $(this).attr("id")).remove();
      z--;
      s--;
      return false;
  });


/**
 * jQuery for modify people
 */



  $("#submit1").on('click', function() {
    var  datas = $("#modifyname").val();
    $('form#modify').trigger('reset');
    $.ajax({
      url : "app/index.php",
      type : "POST",
      data : 'nameSearchModify=' + datas,
      success : function(response) {
        $("#results1").append(response);
        var wrapper_groupe_modify        = $(".input_fields_wrap_groupe_bis"); //Fields wrapper
        var wrapper_ocupation_modify     = $(".input_fields_wrap_occupation_bis"); //Fields wrapper
        var add_occupation_modify        = $(".add_field_button_bis"); //Add button ID
        var add_groupe_modify            = $(".add_field_button_groupe_bis");//Add button group
        var zz = 1;
        var ss = wrapper_ocupation_modify.find(".osup1").length - 1
        var xx = wrapper_ocupation_modify.find(".occ").length - 1
        var yy = wrapper_groupe_modify.find(".gro").length - 1
        var ids;


        $(add_occupation_modify).on('click', function(e){ //on add input button click
          e.preventDefault();
          if(xx < max_fields){ //max input box allowed
            xx++; //text box increment
            $("#occupationsbis" + $(this).attr("id")).append('<tr class="occ" id="c' + xx +'"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" defaultvalue=" " id="oname" name="oname[' + xx +']"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" defaultvalue=" " id="oproject" name="oproject[' + xx +']"></td><td><table><td id ="bb'+ xx +'"><label for="osuper">Nom du superviseur:</label><a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="' + xx + '" style="align: center"></a></br><input type="text" class="form-control" defaultvalue=" " id="osuper" name="osuper[' + xx +']"></td></table></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="ostart" name="ostart[' + xx +']"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="oend" name="oend[' + xx +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' + xx + '" style="align: center"></a></td></tr>'); //add input box
            zz = 1;
          }
          $("#ostart, #oend").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
          });
          $("#occupationsbis" + $(this).attr("id")).on("click",".remove_field_bis", function(e){ //user click on remove text
            e.preventDefault();  $("#c" + $(this).attr("id")).remove();
            xx--;
            ss--;
          })
        });


        $(add_groupe_modify).on('click', function(e){ //on add input button click
          e.preventDefault();
          if(yy < max_fields){ //max input box allowed
            yy++;
            $("#groupesbis" + $(this).attr("id")).append('<tr id="d' + yy +'"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control" defaultvalue=" " id="gname" name="gname[' + yy +']"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="gstart" name="gstart[' + yy +']"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="gend" name="gend[' + yy +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' + yy + '" style="align: center"></a></td></tr>'); //add input box
          }
          $("#gstart, #gend").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
          });
        });
        $("#groupesbis" + $(this).attr("target")).on("click",".remove_field_groupe_bis", function(e){ //user click on remove text
          e.preventDefault(); $("#d" + $(this).attr("id")).remove(); yy--;
        });


        $('.close').unbind().click( function () {
         $('#modify'+$(this).attr('target')).remove();
         return false;
        });

        $(".submit2").on( 'click', function(e) {
          e.preventDefault();
          var datas2 = $("form.modifypeople" + $(this).attr("id")).dataFind('modifyPerson');
          ids = $(this).attr('id');
          //console.log(datas2);
          $.ajax({
            url : 'app/index.php',
            type : 'POST',
            data : datas2,
            dataType: 'json',
            success : function(res) {
              //console.log(res);
              if (res.status == 'Success') {
                console.log(ids);
                $('#modify'+ ids).hide();
                $("#results1").append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span><strong> ' + res.name + ' </strong> a bien été modifié aux membres de l\'AFAM</div>');
                setTimeout(function() {
                  $('.alert').remove();
                }, 4000);
              } else if (res.status == 'errorModify') {
                $(".results2").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span><strong> ' + res.name + ' </strong> n\'a pas été ajouté à la base de donnée ! </div>');
                setTimeout(function() {
                  $('.alert').remove();
                }, 5000);
              } else if (res.status == 'errorSave'){
                $(".results2").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span> <b>' + res.name + '</b> a été ajouté à la base de donnée, mais le formatage et la sauvegarde n\'a pas eu lieu ! </div>');
                setTimeout(function() {
                  $('.alert').remove();
                }, 3000);
              }
            },
            error: function(res){
              $("#results2").append('<div>'+ res.responseText +'</div>');
            }
          });
        });
        $("#occupationsbis1").on("click", ".add_osup", function(e){
          e.preventDefault();
          if(zz < max_fileds_superviseur) {
            zz++;
            ss++;
            $("#bb" + $(this).attr("id")).append('<tr id="g' + zz +'"><td><input type="text" class="form-control col-md-1" content="width=80%" defaultvalue=" " id="'+ zz +'" name="osuper1['+ ss +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="'+ zz +'" style="align: center"></a></td></tr>');
            console.log( $(this).attr("id"));
          }

        });
        $("#occupationsbis1").on("click",".remove_osup", function(e){ //user click on remove text
          e.preventDefault(); $("#g" + $(this).attr("id")).remove(); zz--; ss--;
        });
        $("#groupesbis1").on("click",".remove_field_groupe_bis", function(e){ //user click on remove text
          e.preventDefault(); $("#d" + $(this).attr("id")).remove(); y--;
        });
      }
    });
    return false;
  });
  function getNumbers(inputString){
    var regex=/\d+\.\d+|\.\d+|\d+/g,
    results = [],
    n;

    while(n = regex.exec(inputString)) {
      results.push(parseFloat(n[0]));
    }

    return results;
  }




















});
