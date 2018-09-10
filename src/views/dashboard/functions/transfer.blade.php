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


</script>