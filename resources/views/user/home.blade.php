@extends('layouts.userapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">

                    	<div class="col-md-6">
                    		<form method="get" action="{{url('/inventories')}}">
		                    	<input type="hidden" name="token" value="{{$token}}">
		                    	<button>Inventories</button>
		                    </form> 
                    	</div>

                    	<div class="col-md-6">
                    	@if(Auth::user()->user_role == 'admin')
		                   <form method="get" action="{{url('/users')}}">
		                    	<input type="hidden" name="token" value="{{$token}}">
		                    	<button>Users</button>
		                    </form>
		                 @endif
                    	</div>
                    	
                    </div>
                    

                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
