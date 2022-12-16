<form name="adduser" method="post" enctype="multipart/form-data">
	<div class="form-group m-b-20">
		<label for="exampleInputEmail1">User Name</label>
		<input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" required>
	</div>
	<div class="form-group m-b-20">
		<label for="exampleInputEmail1">User Email</label>
		<input type="text" class="form-control" id="useremail" name="useremail" placeholder="Enter User Email" required>
	</div>
	
	<div class="form-group m-b-20">
		<label for="exampleInputEmail1">User Password</label>
		<input type="text" class="form-control" id="userpass" name="userpass" placeholder="Enter User Password" required>
	</div>

	<div class="form-group m-b-20">
		<label for="exampleInputEmail1">User Role</label>
		<select class="form-control" name="userrole" id="userrole" onChange="getUserRole(this.value);" required>
			<option value="1">Admin </option>
			<option value="2"> Manager </option>
			<option value=""> Customer </option>
		</select> 
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<h4 class="m-b-30 m-t-0 header-title"><b>User Status</b></h4>
				<select class="form-control" name="userstatus" id="userstatus" onChange="getUserStat(this.value);" required>
					<option value="1">Active </option>
					<option value="0"> Inactive </option>
				</select> 
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<h4 class="m-b-30 m-t-0 header-title"><b>User Image</b></h4>
				<input type="file" class="form-control" id="userimage" name="userimage"  required>
			</div>
		</div>
	</div>


	<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save</button>
	<button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
</form>