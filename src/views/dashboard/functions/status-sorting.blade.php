<script>
// Status sorting Scripts
$(document).on('click', '#publishsort', function(){
  var ul, li, a, i;
  ul = document.getElementById("list_zone");
  li = ul.getElementsByClassName('content-item');

  $('.fa-times').removeClass('active');
  $('.fa-eye').removeClass('active');
  $(this).addClass('active');
  for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByClassName("published")[0];
      if (a.innerHTML == '<i class="fa fa-check" aria-hidden="true"></i>') {
          li[i].style.display = "";
      } else {
          li[i].style.display = "none";
      }
  }
});

$(document).on('click', '#unpublishsort', function(){
  var ul, li, a, i;
  ul = document.getElementById("list_zone");
  li = ul.getElementsByClassName('content-item');

  $('.fa-check').removeClass('active');
  $('.fa-eye').removeClass('active');
  $(this).addClass('active');
  for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByClassName("published")[0];
      if (a.innerHTML == '<i class="fa fa-times" aria-hidden="true"></i>') {
          li[i].style.display = "";
      } else {
          li[i].style.display = "none";
      }
  }
});

$(document).on('click', '#allpublishsort', function(){
  var ul, li, a, i;
  ul = document.getElementById("list_zone");
  li = ul.getElementsByClassName('content-item');

  $('.fa-check').removeClass('active');
  $('.fa-times').removeClass('active');
  $(this).addClass('active');
  for (i = 0; i < li.length; i++) {
      li[i].style.display = "block";
  }
});
</script>