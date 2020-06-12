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

    $(document).on('mousedown', '.preview-submit', function(){


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
      setTimeout(transfer, 200);
    });

    function transfer() {
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
      $.each($('.component-write'), function() {
        var forms = $(this).find(".forms");
        var preview = $(this).find(".preview");
        if($(forms).find("input[name='input1[]']").length)
        {
          $(preview).find('.input1').html($(forms).find("input[name='input1[]']").val());
        }
        else {
          $(preview).find('.input1').html($(forms).find("textarea[name='input1[]']").val());
        }
        if($(forms).find("input[name='input2[]']").length)
        {
          $(preview).find('.input2').html($(forms).find("input[name='input2[]']").val());
        }
        else {
          $(preview).find('.input2').html($(forms).find("textarea[name='input2[]']").val());
        }
        if($(forms).find("input[name='input3[]']").length)
        {
          $(preview).find('.input3').html($(forms).find("input[name='input3[]']").val());
        }
        else {
          $(preview).find('.input3').html($(forms).find("textarea[name='input3[]']").val());
        }
        if($(forms).find("input[name='input4[]']").length)
        {
          $(preview).find('.input4').html($(forms).find("input[name='input4[]']").val());
        }
        else {
          $(preview).find('.input4').html($(forms).find("textarea[name='input4[]']").val());
        }
        if($(forms).find("input[name='input5[]']").length)
        {
          $(preview).find('.input5').html($(forms).find("input[name='input5[]']").val());
        }
        else {
          $(preview).find('.input5').html($(forms).find("textarea[name='input5[]']").val());
        }
        if($(forms).find("input[name='input6[]']").length)
        {
          $(preview).find('.input6').html($(forms).find("input[name='input6[]']").val());
        }
        else {
          $(preview).find('.input6').html($(forms).find("textarea[name='input6[]']").val());
        }

      });
    }


</script>