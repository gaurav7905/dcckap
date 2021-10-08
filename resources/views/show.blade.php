<!DOCTYPE html>
<html>
<head>
	<title>DCKAP</title>
</head>
<body>
<div class="container">
	<div class="row">
		<table style="width:60%">
			<thead>
				<th>Name</th>
				<th>User Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Image</th>
				
			</thead>
			<tbody>
				<tr>
				@foreach($data as $key=>$val)
            <td>{{$val->name}}</td>
            <td>{{$val->username}}</td>
            <td>{{$val->email}}</td>
            <td>{{$val->mobile}}</td>
            <td><img src="{{asset('/image/'.$val->image)}}" style="width:40px;height:60px;"></td>

				@endforeach
				</tr>
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript"></script>
</body>
</html>