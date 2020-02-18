<script>
// Remove all pasted in styles.


document.querySelector('.row-editor').addEventListener("paste", function(e) {
      if(e.target.classList.contains('codearea') || e.target.nodeName == 'INPUT'){

      }
      else {
        e.preventDefault();

        var html = e.clipboardData.getData('text/html');
        html = html.replace(/<[^a][^\/a][\s]*([^>]*)+>/g,'');
        html = html.replace(/\u00a0/g,' ');
        html = html.replace(/&nbsp;/g,' ');
        html = html.replace(/(\r\n|\n|\r)/gm," ");
        var atags = html.match(/<a[\s]*([^>]*)>((?:.(?!\<\/a\>)|\s(?!\<\/a\>))*.)<\/a>/g);
        // now I have atags
        var text = e.clipboardData.getData("text/plain");
        text = replaceBreaksWithParagraphs(text);
        text = text.replace(/\u00a0/g,' ');
        text = text.replace(/&nbsp;/g,' ');
        if(atags != null){
          atags.forEach(function(element) {
            //foreach atag, get href
            href = element.match(/href="(.*?)"/g);
            var div = document.createElement("div");
            // set a psuedo element up, and trim to get only the inner text
            // inner = atag text
            div.innerHTML = element;
            var inner = div.innerText;
            // nodes = str start, str end
            var nodes = text.split(inner);
            if(nodes[2]){
              // if multiple matches,
              // check for single word
              if(!/\s/.test(inner))
              {
                singleword = inner+' ';
                var nodes = text.split(singleword);
                // if multiple matches on single word, test with surrounding characters
                if(nodes[2])
                {
                  var result = test10(inner,html,text);
                }
                // if one match, throw in the link
                else if(nodes[1])
                {
                  var result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a> ' + nodes[1];
                }
                // if failed to get any nodes, test with surrounding characters.
                else
                {
                  var result = test10(inner,html,text);
                }
              }
              // if not single word, get surrounding characters
              else
              {
                  var result = test10(inner,html,text);
              }
            }
            // if one match, throw in the link
            else if(nodes[1]){
              var result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a>' + nodes[1];
            }
            else {
              // otherwise, we have no matches. The link will need to be entered manually.
              console.log('No matches');
              console.log(inner);
              var result = text;
            }
            text = result;
          });
        }
        // if no a tags, just paste in teh plain text with new P tags
        document.execCommand("insertHTML", false, text);
      }

    });
    function replaceBreaksWithParagraphs(input) {
      inputs = filterEmpty(input.split('\n')).join('</p><p>');
      return '<p>' + inputs + '</p>';
    }
    function replaceBreaksWithBR(input) {
      inputs = filterEmpty(input.split('\n')).join('<br>');
      return inputs;
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
    }
    function test10(inner,html,text)
    {
      regex = '<a[^>]*>'+inner+'<\/a>(.{10})?';
      regex = new RegExp(regex, 'g');
      var atags = html.match(regex);
      if(atags != null){
        atags.forEach(function(element) {
          //foreach atag, get href
          href = element.match(/href="(.*?)"/g);
          var div = document.createElement("div");
          // set a psuedo element up, and trim to get only the inner text
          // inner = atag text
          div.innerHTML = element;
          var newinner = div.innerText;
          newinner = newinner.replace('&nbsp;',' ',newinner);

          // nodes = str start, str end
          var nodes = text.split(newinner);
          if(nodes[2])
          {
            console.log('still multiple possible matches');
            result = text;
          }
          else if(nodes[1])
          {
            result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a> ' + newinner.substr(inner.length) + nodes[1];
          }
          else
          {
            console.log('something broke while looking for surrounding characters');
            console.log(newinner);
            result = text;
          }
        });
        return result;
      }
      else
      {
        console.log('no atags');
        return text;
      }
    }
    @foreach($type->custom_fields as $custom)
      @if($custom->input == 'textbox')
        document.querySelector('.custom-field-row').addEventListener("paste", function(e) {
              if(e.target.classList.contains('codearea')){

              }
              else {
                e.preventDefault();

                var html = e.clipboardData.getData('text/html');
                html = html.replace(/<[^a][^\/a][\s]*([^>]*)+>/g,'');
                html = html.replace(/\u00a0/g,' ');
                html = html.replace(/&nbsp;/g,' ');
                html = html.replace(/(\r\n|\n|\r)/gm," ");
                var atags = html.match(/<a[\s]*([^>]*)>((?:.(?!\<\/a\>)|\s(?!\<\/a\>))*.)<\/a>/g);
                // now I have atags
                var text = e.clipboardData.getData("text/plain");
                text = replaceBreaksWithParagraphs(text);
                text = text.replace(/\u00a0/g,' ');
                text = text.replace(/&nbsp;/g,' ');
                if(atags != null){
                  atags.forEach(function(element) {
                    //foreach atag, get href
                    href = element.match(/href="(.*?)"/g);
                    var div = document.createElement("div");
                    // set a psuedo element up, and trim to get only the inner text
                    // inner = atag text
                    div.innerHTML = element;
                    var inner = div.innerText;
                    // nodes = str start, str end
                    var nodes = text.split(inner);
                    if(nodes[2]){
                      // if multiple matches,
                      // check for single word
                      if(!/\s/.test(inner))
                      {
                        singleword = inner+' ';
                        var nodes = text.split(singleword);
                        // if multiple matches on single word, test with surrounding characters
                        if(nodes[2])
                        {
                          var result = test10(inner,html,text);
                        }
                        // if one match, throw in the link
                        else if(nodes[1])
                        {
                          var result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a> ' + nodes[1];
                        }
                        // if failed to get any nodes, test with surrounding characters.
                        else
                        {
                          var result = test10(inner,html,text);
                        }
                      }
                      // if not single word, get surrounding characters
                      else
                      {
                          var result = test10(inner,html,text);
                      }
                    }
                    // if one match, throw in the link
                    else if(nodes[1]){
                      var result = nodes[0] + '<a ' + href + ' target="_blank">' + inner + '</a>' + nodes[1];
                    }
                    else {
                      // otherwise, we have no matches. The link will need to be entered manually.
                      console.log('No matches');
                      console.log(inner);
                      var result = text;
                    }
                    text = result;
                  });
                }
                // if no a tags, just paste in teh plain text with new P tags
                document.execCommand("insertHTML", false, text);
              }

            });
      @endif
    @endforeach

</script>