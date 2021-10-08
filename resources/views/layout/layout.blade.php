<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="_token" content="{{csrf_token()}}">
	<title>	DCKAP</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
	
	
</head>
<body>

<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Registration</a>
  <a class="navbar-brand" href="#">Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
     
      <li class="nav-item">
        
      </li>
      
    </ul>
  </div>
</nav>
@yield('form')
@yield('list')
<footer>
	
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js">
   
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
$('#formdata').on('submit',function(e){
	
   e.preventDefault();

 $.ajaxSetup({
       	headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
    });
 
       $.ajax({
       	url:"/registration",
       	type:"POST",
       	processData:false,
       	contentType:false,
       	data :new FormData(this),
       	success:function(data)
       	{
       		
       		if(data.status_code == 200){
       			toastr.success(data.msg);
       		
       			clearForm();
       		}
       		if(data.status_code == 201){
       			toastr.success(data.msg);
       		}
       		if(data.status_code == 202)
       		{
       			$.each(data.msg,function(key,value){
                   toastr.error(value);
       			})
       		}
       	}
       })
	})
function clearForm(){
	$(this.document.activeElement).closest("form").trigger('reset');
}
</script>
 
<script type="text/javascript">

  $(function () {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        'ajax': {          
				'url':'/show' ,
				'data' : {name:name}  
				    	
		}, 
        columns: [
            
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
           
            {
                "mData": null,
                "bSortable": false,
                "mRender": function (data) { 
                    return '<span class="btn btn-danger" onclick="deletedata(' + data.id + ')">' + 'Delete' + '</span><span class="btn btn-secondary" onclick="editdata(' + data.id + ')">' + 'Edit</span>'; 
                  }
            },
        ]
    });
    
  });
  
 function deletedata(id){

  if(confirm("Are you sure ?")){
     	 $.ajaxSetup({
           	headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')}
        });

    	$.ajax(
    	{
    		url : '/delete',
    		data : { user_id : id },
    		type : "POST",
    		success:function(data)
    		{
    			if(data.status_code == 200)
    			{
    				toastr.success(data.msg);
    			}
    			if(data.status_code==202)
    			{
    				toastr.error(data.msg);
    			}
    		}
    	})
  }

}
function editdata(id){
	$.ajax(
	{
		url:'/edit',
		data:{user_id:id},
		type:"GET",
		success:function(response)
		{
			if(response.status_code==200)
			{
             arr = $.parseJSON(response);
             alert(arr);
			}
		}
	})
}
</script>
</footer>
</div>
</body>
</html>