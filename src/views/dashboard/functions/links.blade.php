<script>
// Open linker and add link to selected text
    var selection;
    var range;
    var newrange;
    $( "#linker" ).dialog({ autoOpen: false });
    $( "body" ).on('mousedown', '.linker', function() {
      if (window.getSelection) {
        selection = window.getSelection();
        if (selection.getRangeAt) {
            if (selection.rangeCount > 0) {
                range = selection.getRangeAt(0);
            }
        } else {
            // Old WebKit selection object has no getRangeAt, so
            // create a range from other selection properties
            range = document.createRange();
            range.setStart(selection.anchorNode, selection.anchorOffset);
            range.setEnd(selection.focusNode, selection.focusOffset);

            // Handle the case when the selection was selected backwards (from the end to the start in the document)
            if (range.collapsed !== selection.isCollapsed) {
                range.setStart(selection.focusNode, selection.focusOffset);
                range.setEnd(selection.anchorNode, selection.anchorOffset);
            }
        }
        // With range, we can check to see if it is all dandy
        if (range.startContainer.parentNode.tagName === 'A' || range.endContainer.parentNode.tagName === 'A') {
          var href = range.startContainer.parentNode.getAttribute('href');
          var target = range.startContainer.parentNode.getAttribute('target');
          $("#linker #url").val(href);
          if(target=="_blank"){
            $("#linker #target").prop("checked", true);
          }
          else {
            $("#linker #target").prop("checked", false);
          }
          console.log('success');
        }
        else {
          console.log('attempting to find a tag')
          if (range.commonAncestorContainer.nodeType === 3) {
             newrange = range.commonAncestorContainer.parentNode;
             var href = newrange.getAttribute('href');
             var target = newrange.getAttribute('target');
             if(target=="_blank"){
               $("#linker #target").prop("checked", true);
             }
             else {
               $("#linker #target").prop("checked", false);
             }
             $("#linker #url").val(href);
          }
        }
      }
      else {
        console.log('No selection passed!');
      }

      $( "#linker" ).dialog( "open" );
    });
// a tag functionality
function link() {
  var url = $('#url').val();
  var target = $('#target').prop("checked");
  if (window.getSelection) {
        console.log('selection passed');
        if (range.startContainer.parentNode.tagName === 'A' || range.endContainer.parentNode.tagName === 'A') {
            range.startContainer.parentNode.setAttribute('href',url);
            range.startContainer.parentNode.setAttribute('target', target);
            console.log('Link changed');
            $( "#linker" ).dialog( "close" );
        } else {

        var selectedText = range.extractContents();
        var span = document.createElement("a");
        span.setAttribute('href', url);
        span.setAttribute('target', target);
        span.appendChild(selectedText);
        range.insertNode(span);
        console.log('New link added');
        $( "#linker" ).dialog( "close" );
        }
  }
  else {
    console.log('no pass');
    if (range.startContainer.parentNode.tagName === 'A' || range.endContainer.parentNode.tagName === 'A') {
        range.startContainer.parentNode.setAttribute('href',url);
        range.startContainer.parentNode.setAttribute('target', target);
        console.log('Link changed');
        $( "#linker" ).dialog( "close" );
    } else {

    var selectedText = range.extractContents();
    var span = document.createElement("a");
    span.setAttribute('href', url);
    span.setAttribute('target', target);
    span.appendChild(selectedText);
    range.insertNode(span);
    console.log('New link added');
    $( "#linker" ).dialog( "close" );
    }
  }
}

function unlink() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
      var selection = window.getSelection().getRangeAt(0);
      if(selection){
          if (selection.startContainer.parentNode.tagName === 'A' || selection.endContainer.parentNode.tagName === 'A') {

              var replacementText = selection.startContainer.parentNode.innerHTML;
                  selection.startContainer.parentNode.remove();
                  selection.deleteContents();
                  selection.insertNode(document.createTextNode(replacementText));
          } else {
            return false;
           }
      } else { return false; }
    } else {
        alert("Select a link");
    }

  }
}
</script>