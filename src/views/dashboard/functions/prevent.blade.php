<script>
// Begin link override functions
$(document).on('click', '.tab', function(e){
  $('.expand-tab').removeClass('active');
  $('.tab').removeClass('active');
  $(this).addClass('active');
  var expand = $(this).data('expand');
  $('#'+expand).addClass('active');
});
$(document).on('click', '.component-write a', function(e){
  e.preventDefault();
});
$(document).on('click', '.component-preview a', function(e){
  e.preventDefault();
});
</script>
