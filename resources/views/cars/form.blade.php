@if($viewOnly == 1)
{!! Form::open(array('url' => 'car/save','method'=> 'post','id'=>'create_form'))!!}
	<label>Name:</label>
		<input type="text" name="name" class="form-control"></input>
	<br>
	<label>Color</label>
		<select name="color" class="form-control">
			<option value="0" default>Choose Option</option>
				@foreach($avail_colors as $color)
					<option value="{{$color->id}}">{{$color->color_name}}</option>
				@endforeach
		</select>
	<br>
{!! Form::close()!!}
@elseif($viewOnly == 2)
	<label>Name:</label>
		<input type="text"  class="form-control" value="{{$carx->name}}" disabled=""></input>
	<br>
	<label>Color</label>
		<input type="text" class="form-control" value="{{$carx->colors->color_name}}" disabled=""></input>
	<br>
@else
	<label>Name:</label>
		<input type="text"  class="form-control" value="{{$care->name}}" disabled=""></input>
	<br>
	<label>Color</label>
		<input type="text" class="form-control" value="{{$care->colors->color_name}}" disabled=""></input>
	<br>
	<label>Move To Front Of:</label>
	@if($min == false)
	<select id="move_front" class="form-control">
		<option default>Choose Option</option>
		
		@foreach($allCars as $allcar)
			<option value="{{$allcar->id}}">{{$allcar->name}}</option>
		@endforeach
	</select>
	@else
		<p>This is the Front Car</p>
	@endif

	<br>

	<label>Move To Behind Of:</label>
	@if($max == false)
	<select id="move_behind" class="form-control">
		<option default>Choose Option</option>
		
		@foreach($allCars as $allcar)
			<option value="{{$allcar->id}}">{{$allcar->name}}</option>
		@endforeach
	</select>
	@else
		<p>This is the Last Car</p>
	@endif
@endif