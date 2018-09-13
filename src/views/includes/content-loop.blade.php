<!-- Begin Content Loop.php -->
{{--
* THIS FILE SHOULD NOT BE EDITED
* This file will be overwritten if the cms updates
* to make changes to this file, duplicate it
--}}
@php $count=0; @endphp
@php $ad = 0; @endphp
@foreach($page->rows->sortBy('order') as $row)
  @php $count++; $columncount = 0; $columns = 0; $closed=true; @endphp
  @if($row->order == $count)

    <div class="row component-row">
      <div class="twelve columns">
        {!! $row->content !!}
      </div>
    </div>

  @else
    @while($row->order != $count && $count < 100)
    @foreach($page->components->where('order', $count) as $component)
        @if($component->columns == 'twelve')
          @php $expected = 1; @endphp
        @elseif($component->columns == 'six')
          @php $expected = 2; @endphp
        @elseif($component->columns == 'four')
          @php $expected = 3; @endphp
        @elseif($component->columns == 'three')
          @php $expected = 4; @endphp
        @endif


        @if($columncount == 0)
          @php $closed = false; @endphp
        <div class="row component-row">
        @endif
          @php $columncount++; @endphp
          @include("components.".$component->slug)
        @if($columncount==$expected)
        @php $closed = true; $columncount = 0; @endphp
        </div>
        @endif

      @php $count++; @endphp
      @if($row->order == $count)
        @if($closed != true)
        @php $closed = true @endphp
        </div>
        @endif
        <div class="row component-row">
        <div class="twelve columns">
          {!! $row->content !!}
        </div>
        </div>
        @php $closed = false; $columncount=0; @endphp



      @endif
    @endforeach
  @endwhile
  @endif
@endforeach
@foreach($page->components->where('order', '>', $count) as $component)
  @if($component->columns == 'twelve'|| $component->columns == 'eight')
    @php $expected = 1; @endphp
  @elseif($component->columns == 'six')
    @php $expected = 2; @endphp
  @elseif($component->columns == 'four')
    @php $expected = 3; @endphp
  @elseif($component->columns == 'three')
    @php $expected = 4; @endphp
  @endif


  @if($columncount == 0)
    @php $closed = false; @endphp
  <div class="row component-row">
  @endif
    @php $columncount++; @endphp
    @include("components.".$component->slug)
  @if($columncount==$expected)
  @php $closed = true; $columncount = 0; @endphp
  </div>
  @endif
@endforeach

@if(isset($closed))
  @if($closed != true)
  </div>
  @php $closed = true @endphp
  @endif
@endif
<!-- End Content Loop -->
