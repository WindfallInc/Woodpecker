<script>
// Namesearch Script
function searchFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('SearchInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("list_zone");
    li = ul.getElementsByClassName('content-item');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("name")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>