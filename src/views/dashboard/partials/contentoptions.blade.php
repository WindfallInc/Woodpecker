<div class="backdrop" id="contentoptions">
  <div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
  <div class="content-chooser">
    <div class="row">
      <div class="twelve columns centering">
        <h2>Add Row</h2>
      </div>
    </div>
    <div class="row">
      <div class="twelve columns">
        <ul class="tiles three_up">
          <li>
            <p class="preview-title">Paragraph</p>
            <div class="component-preview paragraph-add">
              <img src="/component/paragraph-component.jpg" alt="">
            </div>
          </li>
        @foreach($components->where('type', 'template') as $component)
          <li><p class="preview-title">{{$component->title}}</p>
            <div class="component-preview" id="{{$component->slug}}">
              @if($component->slug == 'carousal')
                <img src="/component/carousal-component.jpg" alt="">
              @else
                @include("components.".$component->slug)
              @endif
            </div>
          </li>
        @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

