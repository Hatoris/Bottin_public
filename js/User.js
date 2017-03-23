$(document).ready(function(){
  $("#submit").click(function(){
    if($("#name").val() !=''){
      var name = $("#name").val();
      // AJAX Code To Submit Form.
      $.ajax({
        url: "app/index.php",
        type: "POST",
        data: 'nameSearch=' + name,
        success: function(result){
          if (result == 0){
            var html = '<div id="myAlert1" class="alert alert-danger" target="1" role="alert"><a id="linkClose" target="1" href="#" class="close">&times;</a> <strong>';
            var html2 = '</strong> , n\'existe pas la liste des membres de l\'AFAM!</div>';
            var all = html + name + html2;
            $("#results").fadeIn("slow", function() {
              $("#results").html(all);
              setTimeout(function() {
                $('.alert').remove();
              }, 3000);
              $('form').trigger('reset');
            });
          }
          else {
            $("#results").fadeIn("slow", function() {
            $("#results").html(result);
            $('form').trigger('reset');
            });
          }

          $('.close').click( function (e) {
            e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
        });
      }
    });
  }
      else
      {
        alert ('remplissez au moins un champ');
      }

      return false;

  });

new Clipboard('.btn');


//return groupname in the xml file
$.getJSON("app/index.php", { getGroupName: "getName" }).done(function(result) {
      var groupeSelect = $("#groupe");
      $.each(result, function() {
          groupeSelect.append($("<option />").val(this[0]).text(this[0]));
      });
  });

//return table of people in selectd groups or one list of people email in selected group depending on cheked value.
  $("#submit1").click(function () {
    if (typeof $("#groupe").find("option:selected").val() !== "undefined") {
      var groupe = [];
      $("#groupe").find("option:selected").each(function (i, selected) {
              groupe[i] = $(selected).val();
              });
      $("#groupe").find("option:selected").removeAttr("selectd");

      if($("#groupe0:checked").val() == 'table')
        {
          $.ajax({
            url: "app/index.php",
            type: "POST",
            data: 'groupe=' + groupe,
            success: function(result){
              $("#results1").html(result);
                $(".close").click( function (e) {
                  e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
                });
            }
          });
        }
      if($("#groupe1:checked").val() == 'email')
        {
          $.ajax({
            url: "app/index.php",
            type: "POST",
            data: 'groupee=' + groupe,
            success: function(result){
              $("#results1").html(result);
              $(".close").click( function (e) {
                e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
              });
            }
          });
        };
        if($("#groupe2:checked").val() == 'emailMerge')
          {
            $.ajax({
              url: "app/index.php",
              type: "POST",
              data: 'groupeMerge=' + groupe,
              success: function(result){
                $("#results1").html(result);
                $(".close").click( function (e) {
                  e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
                });
              }
            });
          };
    }
    else {alert('Choissisez au moins un groupe !')};
    return false;
  });
});
