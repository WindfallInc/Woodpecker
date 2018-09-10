<script>
// Open linker and add link to selected text
    $( "#linker" ).dialog({ autoOpen: false });
    $( ".linker" ).click(function() {
    $( "#linker" ).dialog( "open" );
  });
// a tag functionality
function link() {
  var url = $('#url').val();
  var target = $('#target').val();
  if (window.getSelection) {
    var selection = window.getSelection().getRangeAt(0);
      if (selection != "") {
        if (selection.startContainer.parentNode.tagName === 'A' || selection.endContainer.parentNode.tagName === 'A') {

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
        } else {

        var selectedText = selection.extractContents();
        var span = document.createElement("a");
        span.setAttribute('href', url);
        span.setAttribute('target', target);
        span.appendChild(selectedText);
        selection.insertNode(span);
        $( "#linker" ).dialog( "close" );
        }
      }
      else{
        $('#error').css('display','block');
      }
  }

}
</script>