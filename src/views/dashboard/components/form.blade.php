@if($component->slug =='questionair')<p class="select-box">Current Form:<select name=@if($component->template == '1')"formid" @else "formid{{$component->id}}@endif">@php $forms = $component->forms(); @endphp <option value="">- Choose A Form -</option>@foreach($forms as $form)<option value="{{$form->id}}" @if($form->id == $component->form_id) selected @endif>{{$form->title}}</option>@endforeach</select><i class="fa fa-sort-desc" aria-hidden="true"></i></p>@endif @isset($component->reqimg)<input type="file" @if($component->template == '1') name="component'+ z +'-img" @else name="component{{$component->id}}-img" @endif class="component-image-selector"><br>@endisset @isset($component->input1){!!$component->input1!!}<br>@endisset @isset($component->input2){!!$component->input2!!}<br>@endisset @isset($component->input3){!!$component->input3!!}<br> @endisset @isset($component->input4){!!$component->input4!!}<br>@endisset @isset($component->input5){!!$component->input5!!} <br> @endisset @isset($component->input6){!!$component->input6!!} <br> @endisset @isset($component->cat_selection)@if($component->template == '1')<select name="typeid' + z + '">@else <select name="typeid{{$component->id}}"> @endif <option value="">- Choose a Datatype -</option>@foreach($types as $type)<option value="{{$type->id}}" @if(isset($component->type_id) && $component->type_id == $type->id) selected @endif>{{$type->title}}</option>@endforeach</select>@endisset @isset($component->type_selection)@if($component->template == '1')<select name="catid' + z + '">@else <select name="catid{{$component->id}}"> @endif <option value="">- Choose a Category -</option>@foreach($categories as $cat)<option value="{{$cat->id}}" @if(isset($component->category->slug) && $component->category->slug == $cat->slug) selected @endif>{{$cat->title}}</option>@endforeach</select>@endisset @isset($component->link_target)<p>Link opens to new tab:</p><div class="row"><div class="two columns outside-link"><label class="switch"><input type="checkbox" @if($component->template == '1') name="link_target'+z+'" @else name="link_target{{$component->id}}" @endif value="on" @if($component->outside == 'on') checked @endif><span class="slider round"></span></label></div></div>@endisset