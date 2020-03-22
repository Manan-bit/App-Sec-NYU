<?php
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Practical Forensics 101</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  	
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

		<div class="container">
            <div class="col-md-12 regdiv">
               
				<form id="myform" method="post">
                    <div class="col-md-6">

                    <div class="col-md-12">
                    <div class="form-group">
                    <h3 style="color:#1a73e8;">Create your Account</h3>
                    </div>
                    </div>

                    <div class="col-md-12" style="margin-top:4%;">
                    <div class="form-group">
                        <p style="font-size:18px;text-align:left;color:#6d6d6d;">Personel Details :</p>
                        <hr style="width: 26%;margin: 0;border-top: 1px solid #6d6d6d;margin-bottom:20px;" />
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
					<input type="text" name="txtbxname" placeholder="Enter Name" class="txtbox" />
                    </div> 
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
					<input type="number" name="txtbxcontactno" placeholder="Enter Contact Number" class="txtbox" />
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group">
					<input type="email" name="txtbxemail" placeholder="Enter Email Address" class="txtbox" />
                    </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
					<input type="password" name="txtbxpswd" placeholder="Enter Password" class="txtbox" />
                    </div>
                    </div>
					
					<div class="col-md-6">
                    <div class="form-group">
                        <p style="font-size:18px;text-align:left;">Gender :</p>
                    </div>

                    <div class="form-group container1">
                        <label class="radio-inline"><input type="radio" name="optradio_gender" value="Male">Male</label>
						<label class="radio-inline"><input type="radio" name="optradio_gender" value="Female">Female</label>
                    </div>
					</div>
					
					<div class="col-md-6">
                    <div class="form-group" style="margin-top:5%;">
                        <p style="font-size:18px;text-align:left;">Age :</p>
                    </div>

                    <div class="form-group"> 
					  <input type="number" name="txtbxage" placeholder="Enter Age" class="txtbox" />
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group" style="margin-top:5%;">
                        <p style="font-size:18px;text-align:left;">City :</p>
                    </div>

                    <div class="form-group"> 
					  <input type="text" name="txtbxcity" placeholder="Enter City" class="txtbox" /><br/>
                    </div>
                    </div>
					
                    </div>

                    <div class="col-md-6" style="margin-top:9%;">
					
					<div class="col-md-12">
                    <div class="form-group">
                        <p style="font-size:18px;text-align:left;">Address :</p>
                    </div>

                    <div class="form-group">
                        <textarea class="txtbox" name="txtbxaddress" placeholder="Enter Address" rows="5"></textarea>
                    </div>
					</div>
					
					<div class="col-md-12">

                    <div class="form-group">
					<input type="submit" name="btn_register" class="regbtn" value="Register"/>
                    </div>

                    <div class="form-group">
						<label>Already Have An Account ?</label>
						<a href="Login.php?login=user" style="text-decoration: none;color: #1a73e8;">Sign In</a>
                    </div> 
                    </div>
					
                    </div>
					
				</form>	
					
              </div>

        </div>
         

<?php

if(isset($_POST['btn_register']))
{	
    $txtbxname = $_POST['txtbxname'];
	$txtbxcontactno = $_POST['txtbxcontactno'];	
	$txtbxemail = $_POST['txtbxemail'];			    
	$txtbxpswd = $_POST['txtbxpswd'];
	$txtbxage = $_POST['txtbxage'];
	$txtbxcity = $_POST['txtbxcity'];
	$txtbxaddress = $_POST['txtbxaddress'];
	$optradio_gender = $_POST['optradio_gender'];
	
	
	$var="select max(uid) as uid from userregister";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$uid_row = $row['uid'];	
	if(!empty($uid_row))
	{				
		$uid = $uid_row + 1;								
	}
	else
	{		
		$uid = '1001';						
	}
		
		
		$sel = "select emailid from userregister where emailid='$txtbxemail'";
		$rel=$con->query($sel);	
		$data=mysqli_fetch_assoc($rel);	
		$emailid_data = $data['emailid'];
						
		if($txtbxemail==$emailid_data)
		{
			echo "<script>alert('This User is already registered');</script>";
		}
		else
		{
			$ins = "Insert into userregister(uid,name,gender,age,contactno,emailid,password,address,city) values('$uid','$txtbxname','$optradio_gender','$txtbxage','$txtbxcontactno','$txtbxemail','$txtbxpswd','$txtbxaddress','$txtbxcity')";			
						
			if(mysqli_query($con, $ins))
			{																				
				echo "<script>alert('Registered Details submitted succesfully');</script>";
				echo "<script>window.location.href='Login.php?login=user'</script>";									
			}	
			else
			{	
				echo "<script>alert('Invalid Registration');</script>";
			}					
		}		
}


?>


		 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>	


<script>

    $(function()
    {
		
            $("#myform").validate({
           
            rules:{
                //txtbxname : "required",
				txtbxname: { 
				required:true,
				accept: "[a-zA-Z]+"
				},
				 		
				txtbxcontactno: {
                    required:true,
                    number:true

                },
				txtbxaddress : "required",		
				txtbxemail: {
                    required:true,
                    email:true

                },				
				txtbxpswd : "required",
				optradio_gender : "required",	
				txtbxage: {
                    required:true,
                    number:true

                },
				txtbxcity : "required",	
            },

            messages:{
                txtbxname:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Name</b></h5>",
				txtbxcontactno:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Contact Number</b></h5>",
				txtbxaddress:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Address</b></h5>",				
				txtbxemail:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Email ID</b></h5>",				
				txtbxpswd:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Password</b></h5>",
				optradio_gender:"<h5 style='color:red;font-size: 15px;'><b>Please Select Valid Gender</b></h5>",
				txtbxage:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Age</b></h5>",
				txtbxcity:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid City</b></h5>",	
				
            },			
			errorPlacement: function(error, element) 
			{
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.container1') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },

            submitHandler: function(form){
                form.submit();
            }

        });

    }); 
</script>
		
									
</body>
</html>