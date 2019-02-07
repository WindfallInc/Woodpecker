<script>
// Begin meta functions
  $('#keywords').on('keyup', function(){
    var words = $.trim($(this).val()).split(" ");
    if(words.length > 15){
      $("#keywordcounter").css('color', '#c24137');
      $("#keywordcounter").html(words.length + ' keywords');
    }
    else {
      $("#keywordcounter").css('color', '#555555');
      $("#keywordcounter").html(words.length + ' keywords');
    }
  });
  $('#meta').on('keyup', function(){
    var words = $(this).val().length;
    if(words > 158){
      $("#metacounter").css('color', '#c24137');
      $("#metacounter").html(words + ' characters');
    }
    else {
      $("#metacounter").css('color', '#555555');
      $("#metacounter").html(words + ' characters');
    }

  });
</script>
