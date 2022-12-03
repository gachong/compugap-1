@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card bg-light mt-3">
		<div class="card-header">
			<h6> Import and Export Excel data to Csv </h6>
		</div>
		<div class="card-body">
			<form action="{{ route('import') }}"
				method="POST"
				enctype="multipart/form-data">
				@csrf
				<input type="file" name="file"
					class="form-control">
				<br>
				<button class="btn btn-success">
					Import User Data
				</button>
				<a class="btn btn-warning"
                   href="{{ route('export-product') }}">
                          Export User Data
                  </a>
			</form>
		</div>
	</div>
		
	    @if (count($imported) > 0)
		<div class="table-responsive">
			<table class="table">
				<table class="table">
					<caption>List of product</caption>
					<thead>
					  <tr>
						<th scope="col">Codigo</th>
						<th scope="col">Articulo</th>
						<th scope="col">Stock</th>
						<th scope="col">Categoría</th>
						<th scope="col">Foto</th>
					  </tr>
					</thead>
					<tbody>	
						@foreach ($products as $product)
						<tr>
							<td>{{ $product->codigo }}</td>
							<td>{{ $product->articule }}</td>
							<td>{{ $product->stocklocal }}</td>
							<td>{{ $product->category }}</td>
							<td><img src="{{ $product->url_image }}" alt="profile Pic" height="100" width="100"></td>
						</tr>	
					@endforeach
				</tbody>
			</table>
		</div>
		<a class="btn btn-warning" href="{{ route('send-info') }}" class="text-sm text-gray-700 underline">Send E-comerce</a>			
	    @else
			<p>No imported file</p>
	    @endif

</div>
@endsection
