<p class="round-button" id="category-select">Select Categories</p>
<div class="modal-backdrop" id="category-selection">
  <div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
    <div class="categories" id="categories">
      <input type="text" placeholder="search categories..." id="categorySearch" onkeyup="searchCategoryFunction()" style="height:40px;">
      @foreach($categories as $cat)
        <div class="cat">
          <p>{{$cat->title}}</p>
          <label class="switch"><input type="checkbox" name="categories[]" value="{{$cat->slug}}" @isset($content->categories) @if($content->categories->contains($cat->id)) checked @endif @endisset><span class="slider round"></span></label>
        </div>
      @endforeach
    </div>
</div>
<p>&nbsp;</p>