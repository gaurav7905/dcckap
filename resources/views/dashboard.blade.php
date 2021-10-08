<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="container card mt-3 pb-4" id="up">
    <h3 class="mt-3 mb-3">Registration</h3>
<form id="formdata">
<div class="col-sm-12">
    <div class="row">
            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" class="form-control"  placeholder="Name">
                 </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="username">Username</label>
                     <input type="text" id="username" name="username" class="form-control"  placeholder="Username">
                </div>
           </div>
           <div class="col-sm-4">
                 <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" name="email" class="form-control"  placeholder="Email">
                 </div>
            </div>

    </div>
</div>
<div class="col-sm-12 mt-3">
    <div class="row">
            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="password">Password</label>
                     <input type="text" id="password" name="password" class="form-control"  placeholder="Password">
                </div>
           </div>
            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="text" id="confirm_password" name="confirm_password" class="form-control"  placeholder="Confirm Password">
                 </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="mobile_number">Mobile Number</label>
                     <input type="text" id="mobile_number" name="mobile" class="form-control"  placeholder="Mobile Number">
                </div>
           </div>

    </div>
</div>
<div class="col-sm-12 mt-3">
    <div class="row">
            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="image">User Profile Image</label>
                      <input type="file" id="image" name="image" class="form-control">
                      <span id="imagename"></span>
                 </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">
                      <label for="dob">DOB</label>
                     <input type="date" id="dob" name="dob" class="form-control"  placeholder="Date of birth">
                </div>
           </div>
            <div class="col-sm-4">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="city">
            </div>
    </div>
</div>
<input type="hidden" name="id" id="id">
<div class="col-sm-12 mt-2">
    <div class="row">
      <div class="col-sm-6">
        <label for="state" class="form-label">State</label>
        <input type="text" name="state" class="form-control" id="state">
      </div>
     <div class="col-sm-6">
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
            <div class="col-sm-2 float-right">
                 <div class="form-group ">
                     <input type="submit"  class="form-control bg-info" id="btn">
                </div>
           </div>

    </div>
</div>
</form>
</div>
<div class="container card p-5 col-sm-12" >
 <div class="row">
    <table class="table table-bordered" id="usedataTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>

    </table>
  </div>
</div>

</x-app-layout>
