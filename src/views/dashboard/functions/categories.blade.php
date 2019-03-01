
<script>
// Category functionality
    $('#category-select').on('click', function(){
      $('#category-selection').addClass('active');
    });
    $('#category-selection .x').on('click', function(){
      $('#category-selection').removeClass('active');
    });
</script>