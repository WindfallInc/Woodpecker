<script>
// sortable functionality
  $(document.body).on("mouseover",'.fa-arrows-v', function() {
      $( "#sortable" ).sortable({cancel: "input,.textarea,textarea,.transfer" });
      $( "#sortable" ).disableSelection();
  } );

  $(document.body).on("mousedown",'.content-bar', function() {
    if ($('#sortable').hasClass('ui-sortable')){
      $( "#sortable" ).sortable("destroy");
      $( "#sortable" ).unbind();
    }
  });

  $(document.body).on("mousedown",'.transfer', function() {
    if ($('#sortable').hasClass('ui-sortable')){
      $( "#sortable" ).sortable("destroy");
      $( "#sortable" ).unbind();
    }
  });

  $(document.body).on("mousedown",'.question-input', function() {
    if ($('#sortable').hasClass('ui-sortable')){
      $( "#sortable" ).sortable("destroy");
      $( "#sortable" ).unbind();
    }
  });

  $(document.body).on("hover",'.question-input', function() {
    if ($('#sortable').hasClass('ui-sortable')){
      $( "#sortable" ).sortable("destroy");
      $( "#sortable" ).unbind();
    }
  });

</script>