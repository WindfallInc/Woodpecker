<script>
// Namesorting Scripts
// sort alphabetically
$('#alphBnt').on('click', function () {
  // add selected effect
  $(this).addClass('active');
  $('#reversealphBnt').removeClass('active');
    var $list = $('.list_zone');
    var $listLi = $('.content-item',$list);
    $listLi.sort(SortByName);
    $.each($listLi, function(index, row){
        $list.append(row);
    });
});

// reverse alphabetical order
$('#reversealphBnt').on('click', function () {
  $(this).addClass('active');
  $('#alphBnt').removeClass('active');
  var $list = $('.list_zone');
  var $listLi = $('.content-item',$list);
  $listLi.sort(SortByName);
  $listLi = $listLi.get().reverse();
  $.each($listLi, function(index, row){
      $list.append(row);
  });
});

//This will sort the names we pass it
function SortByName(a, b){
  var aName = $(a).find("name").text().toLowerCase();
  var bName = $(b).find("name").text().toLowerCase();
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}
</script>