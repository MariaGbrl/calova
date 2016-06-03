@extends('mimin.master')
@section('title', 'Calova Mimin - Daftar User')
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
									
								</p>
								<table class="table">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Name</th>
									  <th>Email</th>
									  <th>Avatar</th>
									</tr>
								  </thead>
								  <tbody>
									@foreach ($users as $user)
										<tr>
									    	<td>{{$user->id}}</td>									    	<td>
									    	<div class="media">
                                                <a href="" class="media-avatar medium pull-left">
                                                   <img src="{{$user->avatar}}">
                                                </a>
                                                </div>									
										
									    	</td>
									    	<td>{{$user->name}}</td>
									    	<td>{{$user->email}}</td>

									    	</tr>
									@endforeach
								  </tbody>
								</table>
								<div class="pagination pagination-centered">
									{!! $users->render() !!}
								</div>
								<br>
								<!-- <hr /> -->
								<br>
							</div>
							
						</div>
@stop