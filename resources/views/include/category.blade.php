<header role="banner" class="sidebar">
    <nav class="nav" role="navigation">
      <ul class="nav__list">
		  @foreach(App\category::with('childs')->where('parent_id',0)->get() as $key => $item)
				@if($item->childs->count() > 0)
        <li>
		<input id="group-{{$key}}" type="checkbox" hidden />
		<label for="group-{{$key}}"><span class="fa fa-angle-right"></span> {{$item->category_name}}</label>
          <ul class="group-list">
			{{-- <li><a href="#">1st level item</a></li> --}}
			@foreach($item->childs as $item2)
				@if($item2->childs->count() > 0)
            <li>
			<input id="sub-group-{{$item2->id}}" type="checkbox" hidden />
			<label for="sub-group-{{$item2->id}}"><span class="fa fa-angle-right"></span> {{$item2->category_name}}</label>
              <ul class="sub-group-list">
				  @foreach($item2->childs as $item3)
							@if($item3->childs->count() > 0)
                <li>
				<input id="sub-sub-group-{{$item3->id}}" type="checkbox" hidden />
				<label for="sub-sub-group-{{$item3->id}}"><span class="fa fa-angle-right"></span> {{$item3->category_name}}</label>
                  <ul class="sub-sub-group-list">
					  	@foreach($item3->childs as $item4)
					<li><a href='/category/{{$item4->id}}'>{{$item4->category_name}}</a></li>
						@endforeach
                  </ul>
				</li>
				@else
				<li><a href='/category/{{$item3->id}}'>{{$item3->category_name}}</a></li>
				@endif
				@endforeach
              </ul>
			</li>
					@else
					
				<li><a href='/category/{{$item2->id}}'>{{$item2->category_name}}</a></li>
				@endif
				@endforeach
          </ul>
		</li>
		@else
		 <li>
		  <input id="group-{{$key}}" type="checkbox" hidden />
		  <li><a href='/category/{{$item->id}}' style="padding-left: 32px">{{$item->category_name}}</a></li>
		  
		 </li>
        @endif
		   
			 @endforeach
      </ul>
    </nav>
  </header>