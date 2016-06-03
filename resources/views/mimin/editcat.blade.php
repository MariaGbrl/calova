@extends('mimin.master')
@section('title', 'Calova Mimin - Edit category')
@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms</h3>
	</div>
	<div class="module-body">
 
 @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
			<form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">
			
				<div class="control-group">
					<label class="control-label" for="basicinput">Category name</label>
					<div class="controls">
						<input id="basicinput" placeholder="Enter your event name" type="text" name="name_interest" value="{{$catz->name_interest}}">
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label">Checkboxes</label>
					<div class="controls">

						
						@foreach($catx as $cat)
							<label class="checkbox">
								<input value="{{$cat->id}}" type="checkbox" name="quizcat_interest[]" checked>
								{{$cat->name}}
							</label>
						@endforeach
					
						@foreach($quizcat as $quiz)
							<label class="checkbox">
								<input value="{{$quiz->id}}" type="checkbox" name="quizcat_interest[]">
								{{$quiz->name}}
							</label>
						@endforeach
					

					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Image</label>
					<div class="controls">
						<img src="{{$catz->image}}">
					</div>
				</div>			

				<div class="control-group">
					<label class="control-label" for="basicinput">Category Image</label>
					<div class="controls">
						<input name="image" id="basicinput" class="span8" type="file" accept="image/*">
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">Submit Form</button>
					</div>
				</div>
			</form>
	</div>
</div>
@stop