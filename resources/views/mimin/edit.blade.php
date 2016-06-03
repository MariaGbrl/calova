@extends('mimin.master')
@section('title', 'Calova Mimin - Edit Events')
@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms</h3>
	</div>
	<div class="module-body">
 
			<form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">
			
			
				<div class="control-group">
					<label class="control-label" for="basicinput">Image</label>
					<div class="controls">
						<img src="{{$events->gambar_event}}">
					</div>
				</div>
			
				<div class="control-group">
					<label class="control-label" for="basicinput">Event name</label>
					<div class="controls">
						<input id="basicinput" placeholder="Enter your event name" class="span8" type="text" name="nama_event" value="{{$events->nama_event}}">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Event date</label>
					<div class="controls">
						<input id="date1" placeholder="Enter your event date" class="span8" type="text" name="tgl_event" value="{{$events->tgl_event}}"> 
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Deadline pendaftaran</label>
					<div class="controls">
						<input id="date2" placeholder="Deadline" class="span8" type="text" name="deadline" value="{{$events->deadline}}">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">Organizer</label>
					<div class="controls">
						<input id="basicinput" placeholder="Nama Organizer " class="span8" type="text" name="organizer" value="{{$events->organizer}}">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Location</label>
					<div class="controls">
						<input id="basicinput" placeholder="Event Location" class="span8" type="text" name="location" value="{{$events->location}}">
					</div>
				</div>			
				
				<div class="control-group">
					<label class="control-label" for="basicinput">Registration Link</label>
					<div class="controls">
						<input id="basicinput" placeholder="URL Registrasi" class="span8" type="text" name="link" value="{{$events->link}}">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Checkboxes</label>
					<div class="controls">
					
						@foreach($interestX as $interest)
							<label class="checkbox">
								<input value="{{$interest->id}}" type="checkbox" name="events_interest[]" checked>
								{{$interest->name_interest}}
							</label>
						@endforeach
					
						@foreach($interests as $interest)
							<label class="checkbox">
								<input value="{{$interest->id}}" type="checkbox" name="events_interest[]">
								{{$interest->name_interest}}
							</label>
						@endforeach
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="basicinput">isi</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="isi">{{$events->isi}}</textarea>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="basicinput">persyaratan</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="persyaratan">{{$events->persyaratan}}</textarea>
					</div>
				</div>				
		
				<div class="control-group">
					<label class="control-label" for="basicinput">Biaya</label>
					<div class="controls">
						<input id="basicinput" placeholder="Biaya pendaftaran" class="span8" type="text" name="biaya" value="{{$events->biaya}}">
					</div>
				</div>		
				
				<div class="control-group">
				<label class="control-label" for="basicinput">Event Type</label>
				<div class="controls">
				 <select name="type">
				 <option value="" <?php echo $events->type == '' ? "selected" : ''; ?> >   </option>
				  <option value="volunteer" <?php echo $events->type == 'volunteer' ? "selected" : ''; ?> >volunteer</option>
				  <option value="course" <?php echo $events->type == 'course' ? "selected" : ''; ?>>course</option>
				  <option value="workshop" <?php echo $events->type == 'workshop' ? "selected" : ''; ?>>workshop</option>
				  <option value="seminar" <?php echo $events->type == 'seminar' ? "selected" : ''; ?>>seminar</option>
				  <option value="competition" <?php echo $events->type == 'competition' ? "selected" : ''; ?>>competition</option>
				  <option value="internship" <?php echo $events->type == 'internship' ? "selected" : ''; ?>>internship</option>
				  <option value="conference" <?php echo $events->type == 'conference' ? "selected" : ''; ?>>conference</option>
				  <option value="scholarship" <?php echo $events->type == 'scholarship' ? "selected" : ''; ?>>scholarship</option>
				</select>
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
					<div class="controls">
						<button type="submit" class="btn">Submit Form</button>
					</div>
				</div>
			</form>
	</div>
</div>
@stop