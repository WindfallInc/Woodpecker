<script>
$(document).ready(function(){
  $('#component-row{{$component->id}}').find("input[name='input1[]']").val('{!!str_replace("'",'&#39;',$component->content1)!!}');
  $('#component-row{{$component->id}}').find("input[name='input2[]']").val('{!!str_replace("'",'&#39;',$component->content2)!!}');
  $('#component-row{{$component->id}}').find("input[name='input3[]']").val('{!!str_replace("'",'&#39;',$component->content3)!!}');
  $('#component-row{{$component->id}}').find("input[name='input4[]']").val('{!!str_replace("'",'&#39;',$component->content4)!!}');
  $('#component-row{{$component->id}}').find("input[name='input5[]']").val('{!!str_replace("'",'&#39;',$component->content5)!!}');
  $('#component-row{{$component->id}}').find("input[name='input6[]']").val('{!!str_replace("'",'&#39;',$component->content6)!!}');
  @if(isset($component->parent->content1) && substr($component->parent->content1, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content1)!!}');
  @endif
  @if(isset($component->parent->content2) && substr($component->parent->content2, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content2)!!}');
  @endif
  @if(isset($component->parent->content3) && substr($component->parent->content3, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content3)!!}');
  @endif
  @if(isset($component->parent->content4) && substr($component->parent->content4, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content4)!!}');
  @endif
  @if(isset($component->parent->content5) && substr($component->parent->content5, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content5)!!}');
  @endif
  @if(isset($component->parent->content6) && substr($component->parent->content6, 0, 13)  == '<content-bar>')
    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content6)!!}');
  @endif
});
</script>