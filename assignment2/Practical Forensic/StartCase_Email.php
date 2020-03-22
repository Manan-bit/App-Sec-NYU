<?php include('UserHeader.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=user'</script>";
}
$uid_session = $_SESSION["uid_session"];

$casetype = $_GET['casetype'];


?>

<div class="content">  
	<div class="container" style="margin-bottom:2%;">
	
	<h4 style="float:left;"><i class="fa fa-arrow-left" style="font-size:18px;color:blue"></i><a href="ViewCase.php?casetype=<?php echo $casetype ?>">View Case</a></h4>
	
	</br>
	
		<div class="col-md-12 col-lg-12">
			<b>Email Forensics:</b>
			E-mail has emerged as the most important application on the Internet for communication of messages, delivery of documents and carrying out transactions. E-mail is a major means of communication, and e-mail programs differ in how and where they store and track e-mail. E-mail evidence is an important part of any computing investigation─ digital forensics investigators must know how e-mail is processed to collect this essential evidence. In addition, with the increase in e-mail scams and fraud attempts with phishing or spoofing, as a forensics professional you need to know how to examine and interpret the unique content of e-mail messages.
			</br>

			<b>Learning Outcomes:</b>
			Upon completion of this practice exercise, you will be able to:
			•	Access the header of the email
			•	Perform email header analysis which includes:
			o	Analyzing email trace: i.e., all the servers the email travelled from to reach the intended receiver
			o	Observing all attributes of the header and deciding which is important for the forensic investigation, what could be used as evidence.
			•	Recognise spoofed emails

		</div>
		
		<div class="col-md-12 col-lg-12 text-center">
		<?php
		
		if(isset($_GET['caseid_new']))
		{
			$caseid = $_GET['caseid_new'];
			
			echo '<a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid_new='.$caseid.'" class="btn btn-primary" style="width:10%;">Start</a>';
		}
		else
		{
			$caseid = $_GET['caseid'];
			
			echo '<a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid.'" class="btn btn-primary" style="width:10%;">Start</a>';
		}
		
		
			
		
		?>
			
		</div>
		
		
	</div>		
</div>
		
<?php include('footer.php') ?>