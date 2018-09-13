<script>
//Start functions.transfer
//begin transfer functions
    $(document).on('mousedown', '.fa-code', function(){


          $.each($('.transfer'), function() {
            var code = $(this).children(".codearea");
            var text = $(this).children(".textarea");
            if($(text).hasClass("active")){
              $(code).val($(text).html().replace(/<div/g, '<p').replace(/\/div/g, '/p'));
            }
            else{
              $(text).html($(code).val());
            }
            //$(code).val($(code).val().replace(/<img[^>\n]*src="data:[^>\n]*\>/g, '<img src="data:placeholder" alt="placeholder.jpg">'));

          });
    });

    $(document).on('keyup', '.forms', function(){


          $.each($('.transfer'), function() {
            var code = $(this).children(".codearea");
            var text = $(this).children(".textarea");
            if($(text).hasClass("active")){
              $(code).val($(text).html().replace(/<div/g, '<p').replace(/\/div/g, '/p'));
            }
            else{
              $(text).html($(code).val());
            }
          });
    });

    $(document).on('mousedown', '.store', function(){


          $.each($('.transfer'), function() {
            var code = $(this).children(".codearea");
            var text = $(this).children(".textarea");
            if($(text).hasClass("active")){
              $(code).val($(text).html().replace(/<div/g, '<p').replace(/\/div/g, '/p'));
            }
            else{
              $(text).html($(code).val());
            }
            $(code).val($(code).val().replace(/src="data:[^>\n]*/g, 'src="data:placeholder"'));
          });
    });

    $( document ).ready(function() {
      $.each($('.component-write'), function() {
        var forms = $(this).find(".forms");
        var preview = $(this).find(".preview");
          $(preview).find('.input1').html($(forms).find("input[name='input1[]']").val());
          $(preview).find('.input2').html($(forms).find("input[name='input2[]']").val());
          $(preview).find('.input3').html($(forms).find("input[name='input3[]']").val());
          $(preview).find('.input4').html($(forms).find("input[name='input4[]']").val());
          $(preview).find('.input5').html($(forms).find("input[name='input5[]']").val());
          $(preview).find('.input6').html($(forms).find("input[name='input6[]']").val());
      });
    });


</script>