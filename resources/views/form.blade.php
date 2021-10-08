@extends('layout/layout')
@section('form')
<div class="container">
	<center><h3 class="mt-5 mb-5">Add List</h3></center>
<form id="formdata">
<div class="col-sm-12">
	<div class="row">
			<div class="col-sm-6">
	 			 <div class="form-group">
	  				  <label for="name">Name</label>
	  				  <input type="text" id="name" name="name" class="form-control"  placeholder="Name">
	 			 </div>
			</div>

			<div class="col-sm-6">
				 <div class="form-group">
	    			  <label for="username">Username</label>
	   				 <input type="text" id="username" name="username" class="form-control"  placeholder="Username">
	  			</div>
	       </div>

	</div>
</div>
<div class="col-sm-12">
	<div class="row">
			<div class="col-sm-6">
	 			 <div class="form-group">
	  				  <label for="email">Email</label>
	  				  <input type="text" id="email" name="email" class="form-control"  placeholder="Email">
	 			 </div>
			</div>

			<div class="col-sm-6">
				 <div class="form-group">
	    			  <label for="password">Password</label>
	   				 <input type="password" id="password" name="password" class="form-control"  placeholder="Password">
	  			</div>
	       </div>

	</div>
</div>
<div class="col-sm-12">
	<div class="row">
			<div class="col-sm-6">
	 			 <div class="form-group">
	  				  <label for="confirm_password">Confirm Password</label>
	  				  <input type="password" id="confirm_password" name="confirm_password" class="form-control"  placeholder="Confirm Password">
	 			 </div>
			</div>

			<div class="col-sm-6">
				 <div class="form-group">
	    			  <label for="mobile_number">Mobile Number</label>
	   				 <input type="text" id="mobile_number" name="mobile" class="form-control"  placeholder="Mobile Number">
	  			</div>
	       </div>

	</div>
</div>
<div class="col-sm-12">
	<div class="row">
			<div class="col-sm-6">
	 			 <div class="form-group">
	  				  <label for="image">User Profile Image</label>
	  				  <input type="file" id="image" name="image" class="form-control">
	 			 </div>
			</div>

			<div class="col-sm-6">
				 <div class="form-group">
	    			  <label for="dob">DOB</label>
	   				 <input type="date" id="dob" name="dob" class="form-control"  placeholder="Date of birth">
	  			</div>
	       </div>

	</div>
</div>

<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-6">
    <label for="validationCustom03" class="form-label">City</label>
    <input type="text" name="city" class="form-control" id="validationCustom03">
    
  </div>
  <div class="col-sm-3">
    <label for="state" class="form-label">State</label>
    	<input type="text" name="state" class="form-control" id="state">
      
    
  </div>
 <div class="col-sm-3">
    <label for="country" class="form-label">country</label>
    	<input type="text" name="country" class="form-control" id="country">
      
    
  </div>
	</div>
</div>
<div class="col-sm-12">
	<div class="row ">
		<div class="form-group">
	    <label for="validationCustom03" class="form-label">Address</label>
	    <textarea class="form-control" name="address" id="address">
	    	
	    </textarea>
	    </div>
  
	</div>
</div>

<div class="col-sm-12 mt-3">
	<div class="row">
			

			<div class="col-sm-12">
				 <div class="form-group">
	    			 
	   				 <input type="submit"  class="form-control bg-info" >
	  			</div>
	       </div>

	</div>
</div>
</form>
</div>
@endsection
@section('list')
<div class="container p-5" >
 <div class="row">
	<table id="table" width="100%">
		<thead>
			<tr>
				<td>Name</td>
				<td>Email</td>
				<td>Mobile</td>
				<td>Status</td>
				<td>Action</td>
				
			</tr>

		</thead>
	</table>
  </div>
</div>
@endsection;