@extends('mimin.master')
@section('title', 'Calova Mimin - Add Events')
@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms</h3>
	</div>
	
	
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	
	<div class="module-body">
 
			<form class="form-horizontal row-fluid" action="add" method="post" enctype="multipart/form-data">
				<div class="control-group">
					<label class="control-label" for="basicinput">Event name</label>
					<div class="controls">
						<input id="basicinput" placeholder="Enter your event name" class="span8" type="text" name="nama_event">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Event date</label>
					<div class="controls">
						<input id="date1" placeholder="Enter your event date" class="span8" type="text" name="tgl_event">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Deadline pendaftaran</label>
					<div class="controls">
						<input id="date2" placeholder="Deadline" class="span8" type="text" name="deadline">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Organizer</label>
					<div class="controls">
						<input id="basicinput" placeholder="Nama Organizer " class="span8" type="text" name="organizer">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Location</label>
					<div class="controls">
						<input id="basicinput" placeholder="Event Location" class="span8" type="text" name="location">
					</div>
				</div>			
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Registration Link</label>
					<div class="controls">
						<input id="basicinput" placeholder="URL Registrasi" class="span8" type="text" name="link">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Checkboxes</label>
					<div class="controls">
						@foreach($interests as $interest)
							<label class="checkbox">
								<input value="{{$interest->id}}" type="checkbox" name="events_interest[]">
								{{$interest->name_interest}}
							</label>
						@endforeach
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Isi</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="isi"></textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">persyaratan</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="persyaratan"></textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Biaya</label>
					<div class="controls">
						<input id="basicinput" placeholder="Biaya pendaftaran" class="span8" type="text" name="biaya">
					</div>
				</div>			
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<input value="0" type="hidden" name="highlight">
							<input value="1" type="checkbox" name="highlight">
							Highlight
						</label>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Event Image</label>
					<div class="controls">
						<input name="image" id="basicinput" class="span8" type="file" accept="image/*">
					</div>
				</div>
				
				<div class="control-group">
				<label class="control-label" for="basicinput">Event Type</label>
				<div class="controls">
				 <select name="type">
				  <option value="">   </option>
				  <option value="volunteer">volunteer</option>
				  <option value="course">course</option>
				  <option value="workshop">workshop</option>
				  <option value="seminar">seminar</option>
				  <option value="competition">competition</option>
				  <option value="internship">internship</option>
				  <option value="conference">conference</option>
				  <option value="scholarship">scholarship</option>
				</select>
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