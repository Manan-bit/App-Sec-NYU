<?php include('UserHeader.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=user'</script>";
}
$uid_session = $_SESSION["uid_session"];



?>

<div class="content">  
	<div class="container" style="margin-bottom:2%;">
	
		<div class="col-md-12 col-lg-12">
			<h4><b>What is Practical Forensics 101?</b></h4>			
			</br>

			<p>Practical Forensics 101 is a narrative incident-based gamified way of learning Digital Forensics. Through this game, you can investigate real world scenarios and deduce your conclusions by discovering the evidence.  
			This game has been developed to create an educational experience while providing entertainment to the players and an opportunity for them to build and strengthen their forensic skills. 
			You will be led through a series of question answer steps, which involve the exploration of the real evidence provided, exposing you to practical experience.
			You need to score points with every step to unlock the next level! 
			Go on! Discover your potential!
			</p>
			
			</br>
			
			<h4><b>Gameplay:</b></h4>			
			</br>

			<p>You have two options, Practice Skills and Play Game.
			If you are a beginner at Digital Forensics and if you would like to develop your skills, you can choose to Practice your skills. Within this you can choose the Email, Network or System pathway, according to which domain of digital forensics interests you.
			If you have sufficient knowledge about Digital Forensic tools and the skills, you can go ahead with playing the game. Every correct answer would reward you points, and you have to collect a sufficient amount to uncover the next part of the story. You will also be provided with the option of downloading the virtual appliance which contains the required evidence. 
			This appliance can be downloaded and is supported on all operating environments. You can read the instructions here. 
			The player would also be provided with an explanation of all terminology appearing in the story, for ease of understanding. 
			There are multiple attempts at answering the questions, as well as hints. Although, you need to be careful, using a hint could throw off some points you’ve earned! 
			</p>

			<p>
				<h3>Please Note:-</h3>
				You can download all required material through our virtual appliance. All tools required to analyse the evidence are also embedded into the appliance.<br>
				Virtual Appliance: A virtual Appliance is a Virtual Machine (VM) image file consisting of a pre-configured OS environment. It is deployed on virtualization technology (in this case we’re using Oracle VirtualBox). <br>
				The configuration Instructions are given below:
		<a href="https://drive.google.com/open?id=1ticKQbrCbVL4NGPGQwAe-6qEni6YRsW8">Instructions</a>

			

		</div>
		
		
	</div>		
</div>
		
<?php include('footer.php') ?>