<div class="side-nav" id="dashboard-nav">
  <nav>
  <a href="/dashboard"><img src="/css/woodpecker/woodpecker-logo.png"></a>
  <div class="navheader">Website Content</div>
  <div class="main-items">
    @foreach($types as $type)
      @if($user->canEditType($type->id))
      <div class="nav-box mini">
        <a href="/dashboard/{{$type->id}}/all"><p><i class="fa fa-cube" aria-hidden="true"></i>{{str_plural($type->title)}}</p></a>
        <div class="options">
          <a href="/dashboard/{{$type->id}}/create" class="new">&#xf067;</a>
          <ul class="subitems">
          @foreach($type->contents->sortByDesc('updated_at')->take(15) as $content)
            <a href="/dashboard/{{$type->id}}/{{$content->id}}/edit"><li>{{$content->title}}</li></a>
          @endforeach
          </ul>
        </div>
      </div>
    @endif
    @endforeach
    @if($user->canEditForms())
    <a href="/dashboard/forms">
      <div class="nav-box mini">
        <p><i class="fa fa-industry" aria-hidden="true"></i>Forms</p>
      </div>
    </a>
    @endif
  </div>


  <div class="navheader">Data</div>
  <div class="main-items">
    <a href="/dashboard/media">
      <div class="nav-box mini">
        <p><i class="fa fa-file-image-o" aria-hidden="true"></i>Media</p>
      </div>
    </a>
    <a href="/dashboard/categories">
      <div class="nav-box mini">
        <p><i class="fa fa-sort-amount-desc" aria-hidden="true"></i>Categories</p>
      </div>
    </a>
  </div>

  <div class="navheader">Administrative</div>
  <div class="main-items">
    @if($user->canEditMenus())
    <div class="nav-box mini">
      <a href="/dashboard/menus">
        <p><i class="fa fa-bars" aria-hidden="true"></i>Menus</p>
      </a>
      <div class="options">
        <a href="/dashboard/menu/create" class="new">&#xf067;</a>
        <ul class="subitems">
        @foreach($menus as $menu)
          <a href="/dashboard/menu/{{$menu->slug}}/edit"><li>{{$menu->title}}</li></a>
        @endforeach
        </ul>
      </div>
    </div>
    @endif
    <div class="nav-box mini">
      <a href="/dashboard/types">
        <p><i class="fa fa-cubes" aria-hidden="true"></i>Datatypes</p>
      </a>
      <div class="options">
        <a href="/dashboard/type/create">&#xf067;</a>
        <ul class="subitems">
          @foreach($types as $type)
            @if($user->canEditType($type->id))
              <a href="/dashboard/type/{{$type->slug}}/edit"><li>{{$type->title}}</li></a>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
    @if($user->isAdmin())
    <div class="nav-box mini">
      <a href="/dashboard/users">
        <p><i class="fa fa-users" aria-hidden="true"></i>Users</p>
      </a>
    </div>
    @endif
  </div>





  {{--<div class="nav-box">
    <a href="/dashboard/components">
      <p><i class="fa fa-cubes" aria-hidden="true"></i>Components</p>
    </a>
    <div class="options">
      <a href="/dashboard/component/create">&#xf067;</a>
      <a onclick="activate(10001)">&#xf0d7;</a>
    </div>
  </div>
  <div class="secondary-side-nav" id="10001">
    <ul>
    @foreach($components as $component)
      <a href="/dashboard/component/{{$component->slug}}/edit"><li>{{$component->title}}</li></a>
    @endforeach
    </ul>
  </div> --}}


  <a href="{{ url('/dashboard/logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
      <div class="nav-box mini">
        <p><i class="fa fa-user" aria-hidden="true"></i>  Logout</p>
      </div>
  </a>

  <form id="logout-form" action="{{ url('/dashboard/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
  </form>

  <div class="expander-arrow">
    <i class="fa fa-angle-right" aria-hidden="true"></i>
  </div>
</nav>
</div>
@push('footer')
  <script>
  function activate(id) {
    document.getElementById(id).classList.toggle('active');
    return false;
    }
  </script>
@endpush
