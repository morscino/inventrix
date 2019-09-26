@extends('layouts.userapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Users') }}</div>

                <div class="card-body">
                	<form method="get" action="{{ url('/admin-create-user') }}">
                    	<input type="hidden" name="token" value="{{$token}}">
                    	<button>Add User</button>
                    </form>
                    <br>

                    <table class="table table-striped">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                    			<th>Email</th>
                    			<th>Role</th>
                    			<th>Created</th>
                    			<th>Updated</th>
                    			
                    			<th>Operations</th>
                    		</tr>
                    	</thead>
                    	
                    	<tbody>
                    	@if(!empty($users))	
                    		@foreach($users as $user)
                    		<tr>
                    			<td>{{$user->name}}</td>
                    			<td>{{$user->email}}</td>
                    			<td>{{$user->user_role}}</td>
                    			<td>{{$user->created_at}}</td>
                    			<td>{{$user->updated_at}}</td>
                    		
                    			<td><form method="get" action="{{url('admin-edit-user/'.$user->id)}}">
				                    	
				                    	<input type="hidden" name="token" value="{{$token}}">
				                    	<button>edit</button>
				                    </form>
				                    <form method="get" action="{{url('admin-delete-user/'.$user->id)}}">
				                    	
				                    	<input type="hidden" name="token" value="{{$token}}">
				                    	<button>delete</button>
				                    </form>
                    				
                    			</td>
                    		</tr>
                    		@endforeach
                    	@else
                    		<tr>
                    			<td>No Data Found</td>
                    		</tr>
                    	@endif	
                    	</tbody>
                    	
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
