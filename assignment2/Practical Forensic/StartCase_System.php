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
	<div class="container">
	
	<h4 style="float:left;"><i class="fa fa-arrow-left" style="font-size:18px;color:blue"></i><a href="ViewCase.php?casetype=<?php echo $casetype ?>">View Case</a></h4>
	
	</br>
	
		<div class="col-md-12 col-lg-12">
		<h4>What is System Forensics?</h4>
		
		System Forensics is a branch of digital forensics that deals with using investigative processes to collect, analyze and present digital evidence for legal proceedings for computer systems. Computers could either constitute a “scene of crime” for example, hacking, or hold evidence in the form of internet history, documents or other files relevant to crimes such as murder, fraud, kidnap and espionage.
</br>
<p>		
It is used by an investigator to – 
Gather information about individuals (WHO)
Determine events that occurred (WHAT)
Construct a timeline of events (WHEN)
Discover methods/tools used (WHAT)
Determine objective of the attacker (WHY)
System Forensics can be challenging to work with. While some of the evidence may be visible, a good portion of an investigator’s work is involved in discovering hidden data inside the systems. 
When dealing with a system, forensic investigators follow a standard set of procedures: Physically isolating the device in question to make sure it cannot be accidentally “contaminated”, or tampered with. Hence, the best practice is to make a digital copy of the storage media of the device in question.
A wide variety of proprietary and open source tools are used for the investigation. You would be getting a hands-on experience with a few of the tools. </br>
<b>Evidence:</b> Information and data of value to an investigation that is stored on, received or transmitted by an electronic device. This evidence can be acquired when electronic devices are seized and secured for examination that may be relied on in court. </br>

<b>Forensic Image:</b> A forensically sound and complete copy of a hard drive or other digital media, generally intended for extracting evidence. The disk image represents the content exactly as it is on the original storage device, including both data and structure information. This helps us find the evidence without making any changes to the real systems.</br>

<b>Integrity Check:</b> A forensic image is often accompanied by a calculated Hash signature to validate that the image is an exact duplicate of the original and has not been modified.</br>

<b>Learning Outcomes:</b>
1)	Creation and Analysis of a Forensic Image of the given media
2)	Recover deleted files
3)	Analyse file properties
</br>
		</p>
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