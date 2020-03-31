<script>
// Date sorting Scripts
var $divs = $(".content-item");
// sort by unix timestamps
$('#unixSort').on('click', function () {
  $(this).addClass('active');
  $('#revunixSort').removeClass('active');
  var numericallyOrderedDivs = $divs.sort(function (a, b) {
      return $(a).find("name").data('unix') - $(b).find("name").data('unix');
  });
  $("#list_zone").html(numericallyOrderedDivs);
});

$('#revunixSort').on('click', function () {
  $(this).addClass('active');
  $('#unixSort').removeClass('active');
  var numericallyOrderedDivs = $divs.sort(function (a, b) {
      return  $(b).find("name").data('unix')- $(a).find("name").data('unix');
  });
  $("#list_zone").html(numericallyOrderedDivs);
});
</script>