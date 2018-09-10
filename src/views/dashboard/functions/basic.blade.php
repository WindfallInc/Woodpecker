<script>
// Start functions.basic
// Add custom formatting options

// Add h1 tags

function h1() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
      var selection = window.getSelection().getRangeAt(0);
      if(selection){
          if (selection.startContainer.parentNode.tagName === 'H1' || selection.endContainer.parentNode.tagName === 'H1') {

              var replacementText = selection.startContainer.parentNode.innerHTML;
                  selection.startContainer.parentNode.remove();
                  selection.deleteContents();
                  selection.insertNode(document.createTextNode(replacementText));
          } else {
            var selectedText = selection.extractContents();
            var span = document.createElement("h1");
            span.appendChild(selectedText);
            selection.insertNode(span);
           }
      } else { return false; }
    } else {
        alert("Select text within a row");
    }

  }
}

// Add h2 tags

function h2() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
      var selection = window.getSelection().getRangeAt(0);
      if(selection){
          if (selection.startContainer.parentNode.tagName === 'H2' || selection.endContainer.parentNode.tagName === 'H2') {

              var replacementText = selection.startContainer.parentNode.innerHTML;
                  selection.startContainer.parentNode.remove();
                  selection.deleteContents();
                  selection.insertNode(document.createTextNode(replacementText));
          } else {
            var selectedText = selection.extractContents();
            var span = document.createElement("h2");
            span.appendChild(selectedText);
            selection.insertNode(span);
           }
      } else { return false; }
    } else {
        alert("Select text within a row");
    }

  }
}

// Add h3 tags

function h3() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'H3' || selection.endContainer.parentNode.tagName === 'H3') {

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
        } else {
          var selectedText = selection.extractContents();
          var span = document.createElement("h3");
          span.appendChild(selectedText);
          selection.insertNode(span);
         }
    } else { return false; }
  }
  else{
    alert("Select text within a row");
  }
  }
}

// Add h4 tags

function h4() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'H4' || selection.endContainer.parentNode.tagName === 'H4') {

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
        } else {
          var selectedText = selection.extractContents();
          var span = document.createElement("h4");
          span.appendChild(selectedText);
          selection.insertNode(span);
         }
    } else { return false; }
  }
  else{
    alert("Select text within a row");
  }
  }
}

// Left Align Text

function left() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'SPAN' || selection.endContainer.parentNode.tagName === 'SPAN') {
          if(selection.startContainer.parentNode.className ==='left'){

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
          }
        } else {
          var selectedText = selection.extractContents();
          var span = document.createElement("span");
          span.className = "left";
          span.appendChild(selectedText);
          selection.insertNode(span);
         }
    } else { return false; }
  }
  else {
    alert("Select text within a row");
  }
  }
}

// Center images and text

function center() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'SPAN' || selection.endContainer.parentNode.tagName === 'SPAN') {
          if(selection.startContainer.parentNode.className ==='centering'){

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
          }
        } else {
          var selectedText = selection.extractContents();
          var span = document.createElement("span");
          span.className = "centering";
          span.appendChild(selectedText);
          selection.insertNode(span);
         }
    } else { return false; }
  }
  else {
    alert("Select text within a row");
  }
  }
}

// Right Align Text

function right() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'SPAN' || selection.endContainer.parentNode.tagName === 'SPAN') {
          if(selection.startContainer.parentNode.className ==='right'){

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
          }
        } else {
          var selectedText = selection.extractContents();
          var span = document.createElement("span");
          span.className = "right";
          span.appendChild(selectedText);
          selection.insertNode(span);
         }
    } else { return false; }
  }
  else{
    alert("Select text within a row");
  }
  }
}

// Bold Function

function bold() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'SPAN' || selection.endContainer.parentNode.tagName === 'SPAN') {
          if(selection.startContainer.parentNode.className ==='bold'){

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
          }
        } else {
          if (selection.startContainer.parentNode.tagName === 'STRONG' || selection.endContainer.parentNode.tagName === 'STRONG') {

              var replacementText = selection.startContainer.parentNode.innerHTML;
                  selection.startContainer.parentNode.remove();
                  selection.deleteContents();
                  selection.insertNode(document.createTextNode(replacementText));
          }
          else{
            var selectedText = selection.extractContents();
            var span = document.createElement("span");
            span.className = "bold";
            span.appendChild(selectedText);
            selection.insertNode(span);
          }
         }
    } else { return false; }
  }
  else {
    alert("Select text within a row");
  }
  }
}

// Italic function

function italic() {
  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
        if (selection.startContainer.parentNode.tagName === 'SPAN' || selection.endContainer.parentNode.tagName === 'SPAN') {
          if(selection.startContainer.parentNode.className ==='italic'){

            var replacementText = selection.startContainer.parentNode.innerHTML;
                selection.startContainer.parentNode.remove();
                selection.deleteContents();
                selection.insertNode(document.createTextNode(replacementText));
          }
        } else {
          if (selection.startContainer.parentNode.tagName === 'I' || selection.endContainer.parentNode.tagName === 'I') {

              var replacementText = selection.startContainer.parentNode.innerHTML;
                  selection.startContainer.parentNode.remove();
                  selection.deleteContents();
                  selection.insertNode(document.createTextNode(replacementText));
          }
          else{
          var selectedText = selection.extractContents();
          var span = document.createElement("span");
          span.className = "italic";
          span.appendChild(selectedText);
          selection.insertNode(span);
          }
         }
    } else { return false; }
  }
  else {
    alert("Select text within a row");
  }
  }
}

// List Function

function lister() {
    var htmlstart = "<ul><li>";
    var htmlend   = "</li></ul>";
    var sel, range;
    if (window.getSelection) {
      if ($("[contenteditable]").is(":focus")) {
        // IE9 and non-IE
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {

            range = sel.getRangeAt(0);

            var content = range.startContainer.parentNode.innerHTML
            if(range.startContainer.parentNode.className !=='textarea active'){
            range.startContainer.parentNode.remove();
            range.deleteContents();
            }
            else{
              range.startContainer.parentNode.innerHTML = '';
            }

            var el = document.createElement("div");
            el.innerHTML = htmlstart+content+htmlend;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            range.insertNode(frag);

            // Preserve the selection
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                range.collapse(true);
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
      }
      else{
        alert("Select text within a row");
      }
    } else if (document.selection && document.selection.type != "Control") {
        // IE < 9
        document.selection.createRange().pasteHTML(html);
    }
}

// List item functionality
// hijack content entry so that we can add new list items

$(document).on('keypress', '.textarea', function(e){
  if (window.getSelection) {
    var sel, node, children, br, range;
    if (e.which == 13) {
        sel = window.getSelection();
        node = $(sel.anchorNode);
        children = $(sel.anchorNode.childNodes);

        // if nothing is selected and the caret is in an empty <li>
        // (the browser seems to insert a <br> before we get called)
        if (sel.isCollapsed && node.is('li') && (!children.length ||
                (children.length == 1 && children.first().is('br')))) {
            e.preventDefault();

            // if the empty <li> is in the middle of the list,
            // move the following <li>'s to a new list
            if (!node.is(':last-child')) {
                node.parent().clone(false)
                    .empty()
                    .insertAfter(node.parent())
                    .append(node.nextAll());
            }

            // insert <br> after list
            br = $('<br>').insertAfter(node.parent());

            // move caret to after <br>
            range = document.createRange();
            range.setStartAfter(br.get(0));
            range.setEndAfter(br.get(0));
            sel.removeAllRanges();
            sel.addRange(range);

            // remove <li>
            node.remove();
        }
        else{
        }
    }

} else if (document.selection) { // internet explorer
    var range, node, children;
    if (e.which == 13) {
        range = document.selection.createRange();
        node = $(range.parentElement());
        children = $(range.parentElement().childNodes);

        // if nothing is selected and the caret is in an empty <li>
        // (the browser seems to insert a <br> before we get called)
        if (!range.htmlText.length && node.is('li') && (!children.length ||
                (children.length == 1 && children.first().is('br')))) {
            e.preventDefault();

            // if the empty <li> is in the middle of the list,
            // move the following <li>'s to a new list
            if (!node.is(':last-child')) {
                node.parent().clone(false)
                    .empty()
                    .insertAfter(node.parent())
                    .append(node.nextAll());
            }

            // insert <br> after list
            br = $('<br>').insertAfter(node.parent());

            // move caret to after <br>
            range = document.body.createTextRange();
            range.moveToElementText(br.get(0));
            range.collapse(false);
            range.select();

            // remove <li>
            node.remove();
        }
    }
}
});



$(document).on('mousedown', '.media-img', function(){

  if (window.getSelection) {
    if ($("[contenteditable]").is(":focus")) {
    var selection = window.getSelection().getRangeAt(0);
    if(selection){
          var span = $(this).clone();
          span[0].classList.remove('media-img');
          span[0].classList.add('content-img');
          selection.insertNode(span[0]);
    } else { return false; }
  }
  else {

    if($('.cursor-save').length){
      var span = $(this).clone();
      span[0].classList.remove('media-img');
      span[0].classList.add('content-img');
      $('.cursor-save').append(span[0]);
    } else {
      alert("Select text within a row");
    }

  }
}
  else{

    //insert at end of row content
  }
});

$(document).on('mousedown', '.textarea', function(){
  $('.cursor-save').removeClass('cursor-save');
  $(this).addClass('cursor-save');
});

// End custom formatting options
</script>