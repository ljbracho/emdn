<?php 
	 include './database/connection.php';
	$q = "SELECT * FROM superadmin";
	$run = mysqli_query($con,$q);
	$rows = mysqli_num_rows($run);
	$resturant_data = mysqli_fetch_assoc($run);
	?>
    <section class="content-header">
	<div class="col-md-12">
      <h1>
        SuperAdmin
      </h1>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class='col-sm-8'>
			<div class="box box-primary">
			<div class="box-body form-editing">
			<form action="" method="post" id='profile-form'>
			<input type='hidden' class='adminid'  value='<?php echo $resturant_data['id'];?>'>
			<div class='col-sm-12'>
			<div class="form-group">

                  <label for="adminname">SuperAdmin Name</label>
                  <input type="text"  class="form-control adminname" name='adminname' disabled value='<?php echo $resturant_data['username'];?>' id="adminname">

            </div>
            </div>
			<div class='col-sm-6'>
			<div class="form-group">

                  <label for="email">Email</label>
                  <input type="text"  class="form-control email"  value='<?php echo $resturant_data['email'];?>' name='email' id="email" >

            </div>
            </div>
			<div class='col-sm-6'>
			<div class="form-group">

                  <label for="pass">Change Password</label>
                  <input type="password"  class="form-control pass"  value='<?php echo $resturant_data['password'];?>' name='pass' id="pass" >

            </div>
            </div>
			</div>
			<div class="box-footer">
			   <div class='col-sm-12'>
			   
               <button type="button" name='sub'  class="btn btn-primary btn-save-setting pull-right">Save Settings</button>

              </div>

              </div>
			</div>
		   </form>
		</div>
    </section>