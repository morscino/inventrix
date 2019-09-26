@extends('layouts.userapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Inventory Items') }}</div>

                <div class="card-body">
                	<form method="get" action="{{url('/inventory-create')}}">
                    	<input type="hidden" name="token" value="{{$token}}">
                    	<button>Add Item</button>
                    </form>
                    <br>

                    <table class="table table-striped">
                    	<thead>
                    		<tr>
                    			<th>Title</th>
                    			<th>Category</th>
                    			<th>Description</th>
                    			<th>Price</th>
                    			<th>Unit</th>
                    			<th>Status</th>
                    			<th>Operations</th>
                    		</tr>
                    	</thead>
                    	
                    	<tbody>
                    	@if(!empty($inventories))	
                    		@foreach($inventories as $inventory)
                    		<tr>
                    			<td>{{$inventory->title}}</td>
                    			<td>{{$inventory->category}}</td>
                    			<td>{{$inventory->description}}</td>
                    			<td>{{$inventory->price}}</td>
                    			<td>{{$inventory->unit}}</td>
                    			<td>{{$inventory->status}}</td>
                    			<td><form method="get" action="{{url('inventory-edit/'.$inventory->id)}}">
				                    	
				                    	<input type="hidden" name="token" value="{{$token}}">
				                    	<button>edit</button>
				                    </form>
				                    <form method="get" action="{{url('inventory-delete/'.$inventory->id)}}">
				                    	
				                    	<input type="hidden" name="token" value="{{$token}}">
				                    	<button>delete</button>
				                    </form>
                    				<!-- <a href="{{url('inventory-edit/'.$inventory->id.'/'.$token)}}">edit</a> -->
                    				<!-- <a href="{{url('inventory-delete/'.$inventory->id.'/'.$token)}}">delete</a> -->
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
