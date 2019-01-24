@extends('dashboard.layout.auth')

@section('content')

  <div class="flex-full">

    @if(session()->has('success'))

    	<div class="row full-wrapper">
        <div class="six columns centered">
          <h3>{!! session()->get('success') !!}</h3>
        </div>
    	</div>

    @else
      <div class="login row full-wrapper">
          <div class="five columns centered">

              <form role="form" method="POST" action="{{ url('/dashboard/login') }}">
                  @csrf
                  <label for="email">Email Address</label>
                  <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus>
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                  <label for="password">Password</label>
                  <input type="password" name="password" placeholder="Password" id="password" >
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                  <input type="submit" value="Login" class="big-submit">
                  <!--
                  <label>
                      <input type="checkbox" name="remember" style="width:20px;"> Remember Me
                  </label> -->
                  <!-- <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>     -->
              </form>

          </div>
      </div>
    @endif

  </div>



  @endsection
