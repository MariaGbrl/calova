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

								<table class="table">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Nama</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>
									@foreach ($cat as $catx)
										<tr>
									    	<td>*</td>
									    	<td>{{$catx->name_interest}}</td>
									    	<td>					    	
										<a class="btn btn-default" href="category/{{$catx->id}}">edit</a>
									    	<a class="btn btn-default" onclick="return confirm('Delete this record?')" href="delcat/{{$catx->id}}">delete</a></td>
									    	</tr>
									    	
									    							    	
									    	
									@endforeach
								  </tbody>
								</table>
								
			<form class="form-horizontal row-fluid" action="" method="post" enctype="multipart/form-data">
				<div class="control-group">
				<div class="controls">
				<input id="basicinput" placeholder="Enter your category name" class="span8" type="text" name="name_interest" value="">
				<button type="submit" class="btn btn-primary large">Add category</button>
				</div>
				</div>							

						
			</form>	
								
								<br>
								<!-- <hr /> -->
								<br>
							</div>
							
						</div>
@stop