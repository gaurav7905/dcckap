<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <title> DCKAP</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

         <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js">
   
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
$('#formdata').on('submit',function(e){
    
   e.preventDefault();

 $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
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
                $('#usedataTable').DataTable().destroy();
                dataUser();
                clearForm();
            }
            if(data.status_code == 201){
                toastr.success(data.msg);
            }
            if(data.status_code == 202){
                $.each(data.msg,function(key,value){
                   toastr.error(value);
                })
            }
            if(data.status_code == 203){
                   toastr.error(data.msg);
            }
        }
       })
    })
function clearForm(){
    $(this.document.activeElement).closest("form").trigger('reset');
    $("#imagename").text('');
    $("#btn").val('Submit');
    $("#id").val('');
}
</script>
 
<script type="text/javascript">

dataUser();
  function dataUser() {
    var table = $('#usedataTable').DataTable({
        processing: true,
        serverSide: true,
        'ajax': {          
                'url':'/show' ,
                'data' : {name:name}  
                        
        }, 
        columns: [
            
            {data: 'name'},
            {data: 'email'},
            {data: 'mobile'},
            
           
            {
                "mData": null,
                "bSortable": false,
                "mRender": function (data) { 
                    return '<span class="btn btn-danger m-1" onclick="deletedata(' + data.id + ')">' + 'Delete' + '</span><a href="#up" ><span class="btn btn-secondary" onclick="editdata(' + data.id + ')">' + 'Edit</span></a><a href="/view/'+data.id+'" ><span class="btn btn-secondary">' + 'View</span></a>'; 
                  }
            },
        ]
    });
    
  };
 function deletedata(id){
    if(confirm("Are you sure ?")){
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
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
                    $('#usedataTable').DataTable().destroy();
                    dataUser();
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
            if(response.status_code==200){
             var res = response.data;
             console.log(res);
             $("#email").prop("disabled",true);
             $("#id").val(res.id);
             $("#name").val(res.name);
             $("#email").val(res.email);
             $("#mobile_number").val(res.mobile);
             $("#username").val(res.username);
             $('#dob').val(res.dofb);
             $("#state").val(res.state);
             $("#city").val(res.city);
             $("#country").val(res.country);
             $("#address").val(res.address);
             $("#imagename").text(res.image);
             $("#btn").val('Update');
            }
        }
    })
}
</script>
</html>
