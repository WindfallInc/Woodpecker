<script>
// Remove all pasted in styles. Because god dammit word.


document.querySelector('.row-editor').addEventListener("paste", function(e) {
      if(e.target.classList.contains('codearea')){

      }
      else {
        e.preventDefault();

        var html = e.clipboardData.getData('text/html');
        var array = html.match(/<a[\s]*([^>]*)>((?:.(?!\<\/a\>)|\s(?!\<\/a\>))*.)<\/a>/g);
        var text = e.clipboardData.getData("text/plain");
        text = replaceBreaksWithParagraphs(text);
        if(array != null){
          array.forEach(function(element) {
            href = element.match(/href="(.*?)"/g);
            var div = document.createElement("div");
            div.innerHTML = element;
            var inner = div.innerText;
            var nodes = text.split(inner);
            if(nodes[1]){
              var result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a>' + nodes[1];
            }
            else {
              var result = nodes[0];
            }
            text = result;
          });
        }


        document.execCommand("insertHTML", false, text);
      }

    });
    function replaceBreaksWithParagraphs(input) {
      inputs = filterEmpty(input.split('\n')).join('</p><p>');
      return '<p>' + inputs + '</p>';
    }
    function filterEmpty(arr)
    {
        var new_arr = [];
        var i = arr.length-1;
        for (i; i >= 0; i--)
        {
            if (arr[i] != "")
                new_arr.push(arr.pop());
            else
                arr.pop();
        }
        return new_arr.reverse();
    };

</script>