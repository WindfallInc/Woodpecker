<footer>
</footer>


  @if (session('error'))
    <div class="notification error">
      <p>{{ session('error') }}</p>
    </div>
    <script>
    $( document ).ready(function() {
      $('.notification').css('top','0px');
      setTimeout( function () {
          $('.notification').css('top','-150px');
          $('.notification').text('LOADING...');
      }, 5000);
    });
    </script>
  @elseif(session('message'))
    <div class="notification active">
      <p>{{ session('message') }}</p>
    </div>
    <script>
    $( document ).ready(function() {
      $('.notification').css('top','0px');
      setTimeout( function () {
          $('.notification').css('top','-150px');
          $('.notification').text('LOADING...');
      }, 5000);
      });
    </script>
  @else
    <div class="notification">
      <p>LOADING...</p>
    </div>
  @endif



@stack('footer')




</body>
</html>
