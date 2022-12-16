<?php 
session_start();
  include('config.php');
  error_reporting(0);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $status = 1;
        $query=mysqli_query($con,"insert into `appointment_table`(app_name,app_email,app_subject,app_msg,app_status) values('$name','$email','$subject','$message','$status')");
        if($query)
        {
            $msg="Appointment Submitted ";
            echo success_result('success',$msg);
        }
        else{
            $error="Something went wrong . Please try again.";   
            
            echo success_result('success',$error);
        } 

    function success_result($res,$msg){
    	if($res == "success"){
    	?>
	    	<div class="alert alert-success" role="alert">
	          <strong>Well done!</strong> <?php echo htmlentities($msg);?>
	        </div>
    	<?php
    	}else{
		?>
			<div class="alert alert-danger" role="alert">
	              <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
	        </div>
		<?php
    	}
    }
    ?>