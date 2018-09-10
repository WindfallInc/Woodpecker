
<script>
// Column functionality
    $(document).on('change', '.column-select', function(){

        var columns = $(this).val();
        var row = $(this)[0].id;
        var thing = "."+row;

        var texts           = $(thing);
        if(columns == 1){
          $(texts).html('<div class="twelve columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div>'); //add input box
        }
        if(columns == 2){
          $(texts).html('<div class="six columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="six columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div>'); //add input box
        }
        if(columns == 3){
          $(texts).html('<div class="four columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="four columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="four columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div>'); //add input box
        }
        if(columns == 4){
          $(texts).html('<div class="three columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="three columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="three columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="three columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div>'); //add input box
        }
        if(columns == 5){
          $(texts).html('<div class="two columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="two columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="two columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="two columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div><div class="two columns transfer"><div class="textarea active" contenteditable="true" ></div><textarea name="column[]" class="codearea"></textarea></div>'); //add input box
        }
    });
</script>