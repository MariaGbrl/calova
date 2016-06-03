@extends('mimin.master')
@section('title', 'Calova Mimin - Dashboard')
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="module">
							<div class="module-head">
								<h3>Tables</h3>
							</div>
							<div class="module-body">
								<p>
									<a href="add" class="btn btn-primary large">Add more events</a>
								</p>
								<table class="table">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Nama</th>
									  <th>Organizer</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>
									@foreach ($events as $event)
										<tr>
									    	<td>{{$event->id}}</td>
									    	<td>{{$event->nama_event}}</td>
									    	<td>{{$event->organizer}}</td>
									    	<td>
									    	<a class="btn btn-default" href="edit/{{$event->id}}">edit</a> 
									    	<a class="btn btn-default" onclick="return confirm('Delete this record?')" href="del/{{$event->id}}">delete</a></td>
									    	</tr>
									@endforeach
								  </tbody>
								</table>
								<div class="pagination pagination-centered">
									{!! $events->render() !!}
								</div>
								<br>
								<!-- <hr /> -->
								<br>
							</div>
							
						</div>
@stop