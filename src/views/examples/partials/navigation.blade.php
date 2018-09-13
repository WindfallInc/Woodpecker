<header>


	<div class="row rowflex">
		<div class="three columns logo">
			<a href="/"><img src="/assets/img/logo.jpg"></a>
		</div>
		<div class="nine columns navigation" id="navigation">
			<ul class="nav">
				@php $menu = $template->menus->first(); @endphp
				@if(isset($menu))
					@foreach($menu->parents() as $nav)
						<li><a href="{{$nav->url}}" target="{{$nav->target}}" @if(count($nav->children())>0) class="has-children" @endif>{{$nav->title}}</a>
						@if(count($nav->children())>0)
									<ul class="submenu">
									@foreach($nav->children() as $child)
										<li><a href="{{$child->url}}" target="{{$child->target}}" @if(count($child->children())>0) class="has-children" @endif>{{$child->title}}</a>
											@if(count($child->children())>0)
												<ul class="subsubmenu">
												@foreach($child->children() as $subchild)
													<li><a href="{{$subchild->url}}" target="{{$subchild->target}}">{{$subchild->title}}</a></li>
												@endforeach
												</ul>
										@endif
										</li>
									@endforeach
									</ul>
						@endif
						</li>
					@endforeach
				@endif
			</ul>
			<div class="hamburger" onclick="expand(this);expandmenu();"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div></div>

		</div>
	</div>

</header>
