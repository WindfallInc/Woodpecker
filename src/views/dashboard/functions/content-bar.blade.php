<script>
// Start Content bar Functions

var bars = document.querySelectorAll('content-bar');

[].forEach.call(bars, function(bar) {
  bar.innerHTML = '<div class="content-bar"><span><i class="fa fa-header" aria-hidden="true" style="font-size:22px;" onmousedown="h1()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:18px;" onmousedown="h2()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:14px;" onmousedown="h3()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:8px;" onmousedown="h4()"></i></span><span><i class="fa fa-bold" aria-hidden="true" onmousedown="bold()"></i><i class="fa fa-italic" aria-hidden="true" onmousedown="italic()"></i></span><span><i class="fa fa-align-left" aria-hidden="true" onmousedown="left()"></i><i class="fa fa-align-center" aria-hidden="true" onmousedown="center()"></i><i class="fa fa-align-right" aria-hidden="true" onmousedown="right()"></i></span><i class="fa fa-list" aria-hidden="true" onmousedown="lister()"></i><i class="fa fa-picture-o" aria-hidden="true" onclick="activate(30000)"></i><span><i class="fa fa-link linker" aria-hidden="true"></i><i class="fa fa-unlink" aria-hidden="true" onmousedown="unlink()"></i></span><i class="fa fa-code" aria-hidden="true" onclick="codeview()"></i></div>';
});

function contentbarcheck(){
  var bars = document.querySelectorAll('content-bar');

  [].forEach.call(bars, function(bar) {
    bar.innerHTML = '<div class="content-bar"><span><i class="fa fa-header" aria-hidden="true" style="font-size:22px;" onmousedown="h1()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:18px;" onmousedown="h2()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:14px;" onmousedown="h3()"></i><i class="fa fa-header" aria-hidden="true" style="font-size:8px;" onmousedown="h4()"></i></span><span><i class="fa fa-bold" aria-hidden="true" onmousedown="bold()"></i><i class="fa fa-italic" aria-hidden="true" onmousedown="italic()"></i></span><span><i class="fa fa-align-left" aria-hidden="true" onmousedown="left()"></i><i class="fa fa-align-center" aria-hidden="true" onmousedown="center()"></i><i class="fa fa-align-right" aria-hidden="true" onmousedown="right()"></i></span><i class="fa fa-list" aria-hidden="true" onmousedown="lister()"></i><i class="fa fa-picture-o" aria-hidden="true" onclick="activate(30000)"></i><span><i class="fa fa-link linker" aria-hidden="true"></i><i class="fa fa-unlink" aria-hidden="true" onmousedown="unlink()"></i></span><i class="fa fa-code" aria-hidden="true" onclick="codeview()"></i></div>';
  });
}
</script>