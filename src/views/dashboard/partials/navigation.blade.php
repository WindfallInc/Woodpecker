<div class="side-nav" id="dashboard-nav">
  <a href="/dashboard"><img src="/css/woodpecker/woodpecker-logo.svg"></a>
  <div class="navheader">&nbsp; <!-- Content --></div>
  @foreach($types as $type)
    @if($user->canEditType($type->id))
    <div class="nav-box">
      <a href="/dashboard/{{$type->id}}/all"><i class="fa @isset($type->icon){{$type->icon}}@else fa-cube @endif" aria-hidden="true"></i><span data="type-{{$type->id}}">{{Str::plural($type->title)}}</span></a>
      <a href="/dashboard/{{$type->id}}/create" class="new">+</a>
    </div>
    @endif
  @endforeach
  @if($user->canEditForms())
  <div class="nav-box">
    <a href="/dashboard/forms"><i class="fa fa-industry" aria-hidden="true"></i><span>Forms</span></a>
  </div>
  @endif
  <div class="navheader">&nbsp; <!-- data --></div>
  <div class="nav-box">
    <a href="/dashboard/media"><i class="fa fa-file-image-o" aria-hidden="true"></i><span>Media</span></a>
  </div>
  <div class="nav-box">
    <a href="/dashboard/categories"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i><span>Categories</span></a>
  </div>
  @if($user->canEditMenus())
  <div class="nav-box">
    <a href="/dashboard/menus"><i class="fa fa-bars" aria-hidden="true"></i><span>Menus</span></a>
  </div>
  @endif
  @if($user->isAdmin())
    @isset($custom_items)
      @foreach($custom_items as $custom)
        <div class="nav-box">
          <a href="{{$custom->content3}}"><i class="{{$custom->content2}}" aria-hidden="true"></i><span>{{$custom->content}}</span></a>
        </div>
      @endforeach
    @endisset
  @endif
  @if($user->isAdmin())
  <div class="nav-box">
    <a href="/dashboard/types"><i class="fa fa-cubes" aria-hidden="true"></i><span>Content Types</span></a>
  </div>
  @endif
  @if($user->isAdmin())
  <div class="nav-box">
    <a href="/dashboard/users"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a>
  </div>
  @endif
  @if($user->isAdmin())
  <div class="nav-box">
    <a href="/dashboard/settings"><i class="fa fa-cogs" aria-hidden="true"></i><span>Settings</span></a>
  </div>
  @endif
  <div class="nav-box">
    <a href="{{ url('/dashboard/logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"
    ><i class="fa fa-user" aria-hidden="true"></i><span>Logout</span></a>
    <form id="logout-form" action="{{ url('/dashboard/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </div>
</div>


@push('footer')
  <script>
  function activate(id) {
    document.getElementById(id).classList.toggle('active');
    return false;
    }
  </script>
@endpush