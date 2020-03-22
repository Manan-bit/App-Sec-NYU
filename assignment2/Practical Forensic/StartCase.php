<?php session_start();
include("connection.php");

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=user'</script>";
}
$uid_session = $_SESSION["uid_session"];

if(isset($_GET['caseid_new']))
{
	$caseid = $_GET['caseid_new'];
}
else
{
	$caseid = $_GET['caseid'];
}	


$pid = $_GET['pid'];
$casetype = $_GET['casetype'];
$btnstate = $_GET['btnstate'];

if(isset($_POST['btn_pause']))
{
  $timer_paused = $_POST['timer_paused'];
  $textbxqid_name = $_POST['textbxqid_name'];
  $status = "Paused:".$name;
  
  $date = date("Y-m-d");
 
  $update = "Update caseprocess set status='$status',timer='$timer_paused',date='$date' where pid='$pid'";
  if(mysqli_query($con, $update))
  {
	echo "<script>alert('Your Case has been Paused');</script>";							
	echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."'</script>";	
	exit;
  } 
  else
  {
	  
  }	
}


if($btnstate == "continue")
{
	$sel_timer="select timer from caseprocess where pid='$pid'";
	$rel_timer=$con->query($sel_timer);
	$data_timer = mysqli_fetch_assoc($rel_timer);
	$time = $data_timer['timer'];
	$time = explode(":",$time);	
}	
else
{
	$sel_time="select time from cases where caseid='$caseid'";
	$rel_time=$con->query($sel_time);
	$data_time = mysqli_fetch_assoc($rel_time);
	$time = $data_time['time'];	
}	

$sel="select casename,scenario,finding from cases where caseid='$caseid'";
$rel=$con->query($sel);
$data = mysqli_fetch_assoc($rel);
$casename = $data['casename'];
$scenario = $data['scenario'];
$finding = $data['finding'];

$sel1="select count(file) as file from evidence where caseid='$caseid'";
$rel1=$con->query($sel1);
$data1 = mysqli_fetch_assoc($rel1);
$noOfFiles = $data1['file'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Practical Forensic</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
   
</head>

<body>
<div class="content">
<div style="margin-left:2%; margin-right:2%;">

		<div class="col-md-12 divstart_box">	
			<div class="col-md-12">
				<h3>Play / Start a case :</h3>
			</div>
			
			<div class="col-md-12">								
				<div id="progressbar">
				</div>
					
				<input type="hidden" id="progressbar_val" value="0"/>				
			</div>			

			<div class="col-md-12" style="margin-top:3%;">
				<div class="col-md-8">
				
				<form method="post">
					<input type="hidden" name="timer_paused" id="timerpaus_id" value=""/>
					
					<?php
					
					$sel4="select status from caseprocess where pid='$pid'";
					$rel4=$con->query($sel4);
					$data4 = mysqli_fetch_assoc($rel4);
					$status = $data4['status'];
					
					
					if (strpos($status, ':') !== false) {
						
						$status1 = explode(":",$status);
						
						echo'<input type="hidden" id="textbxqid" name="textbxqid_name" value="'.$status1[1].'" />';
						
						//echo'<input type="hidden" id="textbxqid" name="textbxqid_name" value="'.$status1[1].'" />';												
					}
					else
					{
						echo'<input type="hidden" id="textbxqid" name="textbxqid_name" value="0" />';
					}
					 			
					?>
					
					
					
					<input type="submit" name="btn_pause" class="btn btn-primary" value="Pause"/>
				</form>
				
				</div>
				<div class="col-md-4 text-right">
				
				<?php
				
				if($btnstate == "continue")
				{
					echo '<h4>Timer: <input id="minutes" type="text" style="width: 23px; border: none; background-color:none; font-size: 20px; font-weight: bold;" value="'.$time[0].'" readonly>: 
					<input id="seconds" type="text" style="width: 23px; border: none; background-color:none; font-size: 20px; font-weight: bold;" value="'.$time[1].'" readonly></h4>';
				}
				else
				{
					echo '<h4>Timer: <input id="minutes" type="text" style="width: 23px; border: none; background-color:none; font-size: 20px; font-weight: bold;" value="'.$time.'" readonly>: 
					<input id="seconds" type="text" style="width: 23px; border: none; background-color:none; font-size: 20px; font-weight: bold;" readonly></h4>';
				}
				?>
				
				</div>
			</div>
			
						
				<div class="col-md-6 divmarg">
				
				<?php
				
				$sel4="select count(question) as question from questions where caseid='$caseid'";
				$rel4=$con->query($sel4);
				$data4 = mysqli_fetch_assoc($rel4);
				$countquestions = $data4['question'];
				
				if($btnstate == "continue")
				{
					$sel_q="select status from caseprocess where pid='$pid'";
					$rel_q=$con->query($sel_q);
					$data_q = mysqli_fetch_assoc($rel_q);
					
					$status_array = explode(":",$data_q['status']);			
					$status_arr=$status_array[1];
					
					
					if (strpos($status_arr, ',') !== false) {
						
						$status_array1 = explode(",",$status_array[1]);	
						$lastqid = end($status_array1);
						$lastqid = $lastqid + 1;												
					}
					else
					{
						if($status_arr == 0)
						{
							$sel_qid="select qid from questions where caseid='$caseid' Order by qid asc Limit 1";
							$rel_qid=$con->query($sel_qid);
							$data_lastqid = mysqli_fetch_assoc($rel_qid);
							$lastqid = $data_lastqid['qid'];
						}
						else
						{
							$lastqid = $status_arr + 1;
						}						
					}	
					
					
					$sel3="select qid,question,hint,qinfo from questions where caseid='$caseid' and qid='$lastqid'";
					$rel3=$con->query($sel3);
					$data3 = mysqli_fetch_assoc($rel3);
					$qid = $data3['qid'];
					$question = $data3['question'];
					$hint = $data3['hint'];
					$qinfo = $data3['qinfo'];	

									
					$update = "Update caseprocess set status='',timer='' where pid='$pid'";					
					if(mysqli_query($con, $update))
					{
						//echo "<script>alert('Your Case has been started');</script>";	
						//echo "<script>window.location.href='StartCase.php?btnstate=".$btnstate."&caseid=".$caseid."&pid=".$pid_array."&casetype=".$casetype."'</script>";
					}
					else
					{
						//echo "<script>alert('Invalid');</script>";	
					}						
				}
				else
				{
					$sel2="select qid,question,hint,qinfo from questions where caseid='$caseid' Order by qid asc";
					$rel2=$con->query($sel2);
					$data2 = mysqli_fetch_assoc($rel2);
					$qid = $data2['qid'];
					$question = $data2['question'];
					$hint = $data2['hint'];
					$qinfo = $data2['qinfo'];
				}	
							
				?>
				
				  <div class="col-md-12 divmarg">
					<label>Question :</label>
					<!--<input type="text" id="textbxquest" value="" class="form-control"/>-->
					
					<label id="textbxquest" style="font-size:16px; font-weight:normal;"><?php echo $question ?></label>
				  </div>
				  
				  <div class="col-md-12 divmarg" style="margin-top:3%;">
					<label>Answer :</label>
					<input type="text" id="textbxans" class="form-control" placeholder="Enter Answer"/></br>
					<label id="lblstatus" style="color:red;"></label>
				  </div>
				  
				  <div class="col-md-12 divmarg">
					<!--<label>Hint :</label>
					<input type="text" id="textbxhint" class="form-control" value="" />-->
					
					<button id="btn_hint"><i style="font-size:17px" class="fa">&#xf062;</i> Hint</button></br></br>
						<div id="hint_div" style="font-size:16px; background-color: rgba(212, 209, 209, 0.81); padding: 10px; display:none;">
							<?php echo $hint ?>
						</div>
				  </div>
				  
				  
				  <input type="hidden" id="textbxpid" class="form-control" value="<?php echo $pid ?>" />
				  <input type="hidden" id="casetype" class="form-control" value="<?php echo $casetype ?>" />
				  <input type="hidden" id="countquestions" class="form-control" value="<?php echo $countquestions ?>" />
				  <input type="hidden" id="noOfQuestions" class="form-control" value="1" />
				  <input type="hidden" id="counter_wrong" class="form-control" value="0" />
				  <input type="hidden" id="caseid" class="form-control" value="<?php echo $caseid ?>" />
				  
				  <div class="col-md-12 divmarg" style="margin-top:8%;">
					<button type="button" class="btn btn-primary btn_next" id="btnnext" value="<?php echo $qid ?>" data-id="<?php echo $caseid ?>">Next</button>				
					<!--<button type="button" style="margin-left:5%;" class="btn btn-success btn_end" id="btnend" value="<?php //echo $qid ?>" data-id="<?php //echo $caseid ?>">End Test</button>-->
					
				  </div>
				  
				  <div class="col-md-12 divmarg" style="margin-top:3%;">
					<p id="qinfo"><?php echo $qinfo ?></p>				
				  </div>
				  
				  <div class="col-md-12 divmarg" style="margin-top:2%;">
					  
					<button type="button" id="btn_step1" class="btn btn-secondary" style="display:none;">Step 1</button>
					<button type="button" id="btn_step2" class="btn btn-secondary" style="display:none;">Step 2</button>
					<button type="button" id="btn_step3" class="btn btn-secondary" style="display:none;">Step 3</button>
					<button type="button" id="btn_step4" class="btn btn-secondary" style="display:none;">Step 4</button>
					<button type="button" id="btn_step5" class="btn btn-secondary" style="display:none;">Step 5</button>
					<button type="button" id="btn_step6" class="btn btn-secondary" style="display:none;">Step 6</button>
					 
				  </div>
				  
				  <div class="col-md-12 divmarg" style="margin-top:2%;">
					 <div id="step1" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
					 <div id="step2" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
					 <div id="step3" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
					 <div id="step4" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
					 <div id="step5" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
					 <div id="step6" style="font-size:16px; background-color: rgba(233, 230, 230, 0.81); padding: 10px; display:none;"></div>
				  </div>
				  
				</div>
				
				<div class="col-md-6 divmarg" style="border: 1px solid #d0d0d0;">
					<h4><b>Case Details :</b></h4>
					
					<div class="col-md-6 divmarg">
						<label>Case Name : <span style="font-size: 17px; font-weight: normal;"><?php echo $casename ?></span></label>
					</div>
					
					
					<?php
					
					if($caseid == 101)
					{
					?>					
					<div class="col-md-6 text-right">
						<button class="btn btn-primary btn_view">View More Details</button>
					</div>
					<?php
					}
					else
					{
					?>
						
					<?php
					}					
					?>
					
					<div class="col-md-12 col-lg-12 divmarg">						
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a href="#Scenario">Scenario</a></li>
							<li><a href="#Findings">Findings</a></li>
							<li><a href="#Evidence">Evidence</a></li>
						</ul>
					</div>
					
					<div class="tab-content">
						<div class="tab-pane fade in active col-md-12 divmarg" id="Scenario" style="margin-top:3%;">							
							<label>Scenario : <span style="font-size: 15px; font-weight: normal;"><?php echo $scenario ?></span></label>			
						</div>
						
						<div class="tab-pane fade in col-md-12 divmarg" id="Findings" style="margin-top:3%;">			
							<label>Findings : <span style="font-size: 15px; font-weight: normal;"><?php echo $finding ?></span></label>			
						</div>
						
						<div class="tab-pane fade in col-md-12 divmarg" id="Evidence" style="margin-top:3%;">							
							<label>Evidence : <span style="font-size:16px; font-weight: normal;"><?php echo $noOfFiles ?> Files</span></label>							
							
							<table class="table table-bordered table-hover">	
							<?php
								
							$sel1 = "select id,file from evidence where caseid='$caseid'";
							$rel1=$con->query($sel1);
							if(mysqli_num_rows($rel1)==0)
							{			  
								echo "<center><h3>No files to display</h3></center>";					
							}
							else
							{					
								echo'<thead style="background-color:grey;color:white">           
								<tr>	
								<th>File Name</th>				
								<th>Action</th>					
								</tr>
								</thead>

								<tbody>';
									  
								while($data1=mysqli_fetch_array($rel1))
								{	
									$file=$data1['file'];
									$id=$data1['id'];
									
									echo'<tr>
									<td>'.$file.'</td>				
									<td><a href="Downloadfile.php?fileid='.$id.'">Download</a></td>
									</tr>';
									
								}
								echo'</tbody>';
							}
									
							?>
							
							</table>
							
							
						</div>						
					</div>				
								
				</div>
		
			
		</div>
		
</div>	
</div>
</br>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog" style="width:70%;">

	<!-- Modal content-->
	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">View Details</h4>
			</div>
			<div class="modal-body" style="overflow: auto;">
				<div class="col-md-12 col-lg-12">
				
					<?php
					
					if($caseid == 101)
					{
					?>
					<h4>Here is the message request:</h4>
		
					<img src="images/Emailinfo.png" alt=""/></br>
					
					<h4>Before we start:</h4>
					<p>An electronic mail consists of two parts, the header and the body. The header part carries information that is needed for email routing, subject line and time stamps while the body contains the actual message/data of an email. The header contains several mandatory and optional fields which are used for identification, delivery and other purposes. 
					The header contains several important attributes that give crucial information about the email and where it came from.
					</p>
					</br>
					
					<h4>Here is the complete email header for this case:</h4>
					</br>
					
					<h4>Complete Email Header Evidence:</h4>
					
					<p>
					Delivered-To: svashi1997@gmail.com
					Received: by 2002:a17:90a:bf8c:0:0:0:0 with SMTP id d12-v6csp1353502pjs;
							Sun, 21 Oct 2018 01:40:22 -0700 (PDT)
					X-Google-Smtp-Source: ACcGV61lDjw4DjoecdOPHdvB2thhN8NJFjfTQiMKl7W304SxPsnn3ij7Q/zWtvU8Shl+Qohd5Q+m
					X-Received: by 2002:aed:2498:: with SMTP id t24-v6mr40253643qtc.131.1540111222240;
							Sun, 21 Oct 2018 01:40:22 -0700 (PDT)
					ARC-Seal: i=1; a=rsa-sha256; t=1540111222; cv=none;
							d=google.com; s=arc-20160816;
							b=jyplr0XBj/3K+TviIrS1LS/Fn+QGeDOpWSJPmSqSBxfnJw1X9ELkgG5EY23vjxj1K8
							 dybNAkM7oRt3aq0eO3PP1lQlpxUY9dCAu/t57ohQ2OE1fkeXbY1jlBIHcVHZuLv8XdW5
							 /zAG9tdEcDBdAwaaTEjax40qmUMy4HoZH+RbFYziDA2sHxqbuhiHd7ZjGYnLYMBoLgGu
							 Z5LHPtmHH5jpZDPCp3ryBURFBaOlJBbSQHlN0/sJG/qmuEySTU7s8wiK294kvdBufcRT
							 TQSzJSb+YvBVsUZf65RIarSQMYAlsHiTLuuGiJFlG4zGXSqiz8xanOIhU5I8sXWAg4mG
							 6ESQ==
					ARC-Message-Signature: i=1; a=rsa-sha256; c=relaxed/relaxed; d=google.com; s=arc-20160816;
							h=date:message-id:reply-to:errors-to:importance:from:subject:to;
							bh=b0Knq4x0uNbk0JcOtqfxwgFfEv9u9Yxt7kFH1n787/8=;
							b=KxjRiGNEwAqxqmR7BWN6JCpVzPmYGW2lNrEAHURRH7Tc4ABJTTPnf7dnhoQvfLCa7X
							 /xyRoZHiMhTJwChAaq4qNfws2e2hApX51CEj1eetNKUe2TzMJCcrQA5FXlUILmssio+I
							 8LH/hBu4+FE3/Lf1jbrTHlUhwZEi2MrbM/71OtUFgnlcILdC1xOIzoiAlTaVa3lC/0xt
							 FBqYxNaL+8ch9Fey3Mhj3OpjWbhCvT9GmOZLCun3WQnk0UoDhHSKBiMpGnjG90juBC7a
							 HcVQ+cc+ELhJxOIgPVo1Pb514vp5sixxZX62DiFrbQnqwrJZTOH2PA9wd2MmqmPWrtPL
							 jlRg==
					ARC-Authentication-Results: i=1; mx.google.com;
						   spf=neutral (google.com: 46.167.245.206 is neither permitted nor denied by best guess record for domain of akshar.shah@minitech.com) smtp.mailfrom=akshar.shah@minitech.com
					Return-Path: <akshar.shah@minitech.com>
					Received: from emkei.cz (emkei.cz. [46.167.245.206])
							by mx.google.com with ESMTPS id k11si5435088qvc.180.2018.10.21.01.40.21
							for <svashi1997@gmail.com>
							(version=TLS1_2 cipher=ECDHE-RSA-AES128-GCM-SHA256 bits=128/128);
							Sun, 21 Oct 2018 01:40:22 -0700 (PDT)
					Received-SPF: neutral (google.com: 46.167.245.206 is neither permitted nor denied by best guess record for domain of akshar.shah@minitech.com) client-ip=46.167.245.206;
					Authentication-Results: mx.google.com;
						   spf=neutral (google.com: 46.167.245.206 is neither permitted nor denied by best guess record for domain of akshar.shah@minitech.com) smtp.mailfrom=akshar.shah@minitech.com
					Received: by emkei.cz (Postfix, from userid 33) id CB290D64ED; Sun, 21 Oct 2018 10:40:20 +0200 (CEST)
					To: svashi1997@gmail.com
					Subject: Transfer of Funds
					From: "Akshar Shah, MD" <akshar.shah@minitech.com>
					X-Priority: 3 (Normal)
					Importance: Normal
					Errors-To: akshar.shah@minitech.com
					Reply-To: akshar.shah@minitech.com
					Content-Type: text/plain; charset=utf-8
					Message-Id: <20181021084020.CB290D64ED@emkei.cz>
					Date: Sun, 21 Oct 2018 10:40:20 +0200 (CEST)

					Dear Rajesh,

					Please transfer Rs. 6.2 Lakh in each of the following accounts by the end of the week:

					M-4653 8283 6601 9807
					J-2568 8433 3485 4237
					L-4893 4856 9982 5843

					Kind regards,
					Akshar Shah
					Managing Director
					Minitech India
					
					</p>
				
					<?php
					}
					
					?>
					
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>				  					
			</div>
	</div>
	
</div>
</div>
			

<?php


include('footer.php') ?>

<script type="text/javascript">

// set minutes
var mins = document.getElementById("minutes").value;
var secs_val = document.getElementById("seconds").value;

var caseid = document.getElementById("caseid").value;
//var secs = mins * 60;

if(secs_val == "")
{
	secs = 60;
}
else
{ 
	secs = secs_val;
}	

// calculate the seconds (don't change this! unless time progresses at a different speed for you...)
function countdown() {
	setTimeout('Decrement()',1000);
}
function Decrement() {
	
	var pid = document.getElementById("textbxpid").value;
	var casetype = document.getElementById("casetype").value;
	
	if (document.getElementById) {
		minutes = document.getElementById("minutes");
		seconds = document.getElementById("seconds");
		
		// if less than a minute remaining
		if (seconds < 59) 
		{
			seconds.value = secs;
		} 
		else 
		{				
				minutes.value = getminutes();
				if(minutes.value >= 0)
				{
					seconds.value = getseconds();
					//console.log(seconds.value);
				
					document.getElementById("timerpaus_id").value = minutes.value+":"+seconds.value;
				}
				else
				{
					minutes.value = 0;
					seconds.value = 0;
					//alert("Time Up!!!");				
					//window.location.href="ViewResult.php?casetype="+casetype+"&timeup=0&pid="+pid;
					window.location.href="ViewResult_Practice.php?casetype="+casetype+"&timeup=0&pid="+pid+"&caseid="+caseid;	
				}				
			
		}
		secs--;
		setTimeout('Decrement()',1000);
	}
}
function getminutes() {
	// minutes is seconds divided by 60, rounded down
	//mins = Math.floor(secs / 60);
	if(secs == 60)
	{
		mins--;
	}
	else if(secs == 0)
	{
		mins--;
	}
	

	return mins;
}
function getseconds() {
	// take mins remaining (as seconds) away from total seconds remaining
	//return secs-Math.round(mins *60);
	
	if(mins >=1 && secs == 0)
	{
		secs = 60;
	}	
	else if(mins == 0 && secs== 0)
	{
		secs = 60;
	}
	return secs;

}


function progress(){
 var progress_value = $("#progressbar_val").val();
	progress_value = parseInt(progress_value);
	if(progress_value != 0)
	{
		$("#progressbar")
    .progressbar({ value: progress_value })
    .children('.ui-progressbar-value')
	.html(progress_value + '%')
    .css({"display": "block", "text-align": "center", "background": "#337ab7", "background-size": "5rem 5rem"});

	$( "#progressbar" ).find(".ui-progressbar-value").css("background-image", "linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)");
	
	}
 }
  
  
$(document).ready(function(){ 
	countdown();	
	
 $("#hint_div").hide();
 
 
  $("#btn_hint").click(function(){
    $("#hint_div").slideToggle();
	$("#hint_div").show();
	
  });

  
$('.btn_next').click(function(){

	 var id = $(this).attr("value");
	 var caseid = $(this).attr("data-id");
	 var answ = $("#textbxans").val();
	 var pid = $("#textbxpid").val();
	 var totalqid = $("#textbxqid").val();
	 
	 var pid = $("#textbxpid").val();
	 var casetype = $("#casetype").val();
	 var countquestions = $("#countquestions").val();
	 var noOfQuestions = $("#noOfQuestions").val();
	 var counter_wrong = $("#counter_wrong").val();
	 
	 
	 $("#hint_div").slideUp();
	 
	 
	 if(answ == "")
	 {
		alert("Please Enter an Answer");
		$("#hint_div").slideUp();
	 }
	 else
	 {							
					 
		 $.ajax({
			url:"StartCase_quest.php",
			method:"POST",
			data:{totalqid:totalqid,qid:id,caseid:caseid,answ:answ,pid:pid,noOfQuestions:noOfQuestions,counter_wrong:counter_wrong},
			dataType:"json",
			success:function(data)
			{
				//console.log(data);
				
				if(data.qid == null || data.qid == "")
				{
					//window.location.href="ViewResult.php?casetype="+casetype+"&quest=done&pid="+pid;
					window.location.href="ViewResult_Practice.php?casetype="+casetype+"&quest=done&pid="+pid+"&caseid="+caseid;
				}
				else
				{				
					$("#btnnext").val(data.qid);				
					$("#textbxquest").text(data.question);
					$("#hint_div").text(data.hint);
					$("#qinfo").text(data.qinfo);
					$("#counter_wrong").val(data.counter_wrong);
					
					$("#step1").text(data.step1);
					$("#step2").text(data.step2);
					$("#step3").text(data.step3);
					$("#step4").text(data.step4);
					$("#step5").text(data.step5);
					$("#step6").text(data.step6);
					
					
										
					if(data.status == "Wrong")
					{
						if(data.counter_wrong == 3)
						{
							$("#lblstatus").text("This is the Wrong Answer");
							
							if(data.step1 == "")
							{
								$("#step1").text("No Steps Available");
							}
							
							if(data.step2 == "")
							{
								$("#step2").text("No Steps Available");
							}
							
							if(data.step3 == "")
							{
								$("#step3").text("No Steps Available");
							}
													
							if(data.step4 == "")
							{
								$("#step4").text("No Steps Available");
							}
							
							if(data.step5 == "")
							{
								$("#step5").text("No Steps Available");
							}
							
							if(data.step6 == "")
							{
								$("#step6").text("No Steps Available");
							}
							
							$("#btn_step1").removeClass("btn-success");
							$("#btn_step2").removeClass("btn-success");
							$("#btn_step3").removeClass("btn-success");
							$("#btn_step4").removeClass("btn-success");
							$("#btn_step5").removeClass("btn-success");
							$("#btn_step6").removeClass("btn-success");
							
							$("#btn_step1").show();
							$("#btn_step2").show();
							$("#btn_step3").show();
							$("#btn_step4").show();
							$("#btn_step5").show();
							$("#btn_step6").show();
							
						}
						else
						{
							$("#lblstatus").text("");
							
							$("#btn_step1").hide();
							$("#btn_step2").hide();
							$("#btn_step3").hide();
							$("#btn_step4").hide();
							$("#btn_step5").hide();
							$("#btn_step6").hide();				
						}
					}
					else
					{						
						$("#lblstatus").text("");
						$("#textbxqid").val(data.totalqid);
						$("#noOfQuestions").val(data.noOfQuestions);						
						$("#textbxans").val("");
						
						var totalpercnt = (noOfQuestions/countquestions)*100;
						$("#progressbar_val").val(totalpercnt);
						
						progress();
						
						$("#counter_wrong").val(0);
						
						$("#btn_step1").hide();
						$("#btn_step2").hide();
						$("#btn_step3").hide();
						$("#btn_step4").hide();
						$("#btn_step5").hide();
						$("#btn_step6").hide();
						
						$("#step1").hide();
						$("#step2").hide();
						$("#step3").hide();
						$("#step4").hide();
						$("#step5").hide();
						$("#step6").hide();
						
						
						
						alert("This is the Right Answer");

					}
										
				}
					
			}			
						
		 });
	 }	 
   
  });
  
  
  
  /*$('.btn_end').click(function(){
	    
	var id = $(this).attr("value");
	var caseid = $(this).attr("data-id");
	var pid = $("#textbxpid").val();
	var casetype = document.getElementById("casetype").value;
	  
	window.location.href="ViewResult.php?casetype="+casetype+"&endtest=done&pid="+pid; 
	 
  });*/ 
  
  
  $("#myTab a").click(function(e){
    	e.preventDefault();
    	$(this).tab('show');
    });
	
	
	$(".btn_view").click(function(){	 
		$("#myModal").modal('show');		
	});
	
	
	$("#btn_step1").click(function(){
		$(this).addClass("btn btn-success");
		$("#btn_step2").removeClass("btn btn-success");
		$("#btn_step3").removeClass("btn btn-success");
		$("#btn_step4").removeClass("btn btn-success");
		$("#btn_step5").removeClass("btn btn-success");
		$("#btn_step6").removeClass("btn btn-success");
		
		$("#btn_step2").addClass("btn btn-secondary");
		$("#btn_step3").addClass("btn btn-secondary");
		$("#btn_step4").addClass("btn btn-secondary");
		$("#btn_step5").addClass("btn btn-secondary");
		$("#btn_step6").addClass("btn btn-secondary");
		
		$("#step1").slideToggle();
		$("#step1").show();
		$("#step2").hide();
		$("#step3").hide();
		$("#step4").hide();
		$("#step5").hide();
		$("#step6").hide();
		
	});

	$("#btn_step2").click(function(){
		$(this).addClass("btn btn-success");
		$("#btn_step1").removeClass("btn btn-success");
		$("#btn_step3").removeClass("btn btn-success");
		$("#btn_step4").removeClass("btn btn-success");
		$("#btn_step5").removeClass("btn btn-success");
		$("#btn_step6").removeClass("btn btn-success");
		
		$("#btn_step1").addClass("btn btn-secondary");
		$("#btn_step3").addClass("btn btn-secondary");
		$("#btn_step4").addClass("btn btn-secondary");
		$("#btn_step5").addClass("btn btn-secondary");
		$("#btn_step6").addClass("btn btn-secondary");
		
		
		$("#step2").slideToggle();		
		$("#step2").show();
		$("#step1").hide();
		$("#step3").hide();
		$("#step4").hide();
		$("#step5").hide();
		$("#step6").hide();
		
	});	
	
	$("#btn_step3").click(function(){
		$(this).addClass("btn btn-success");
		$("#btn_step1").removeClass("btn btn-success");
		$("#btn_step2").removeClass("btn btn-success");
		$("#btn_step4").removeClass("btn btn-success");
		$("#btn_step5").removeClass("btn btn-success");
		$("#btn_step6").removeClass("btn btn-success");
		
		$("#btn_step1").addClass("btn btn-secondary");
		$("#btn_step2").addClass("btn btn-secondary");
		$("#btn_step4").addClass("btn btn-secondary");
		$("#btn_step5").addClass("btn btn-secondary");
		$("#btn_step6").addClass("btn btn-secondary");
		
		$("#step3").slideToggle();
		$("#step3").show();
		$("#step1").hide();
		$("#step2").hide();
		$("#step4").hide();
		$("#step5").hide();
		$("#step6").hide();
		
	});
	
	$("#btn_step4").click(function(){
		$("#step4").slideToggle();
		
		$(this).addClass("btn btn-success");
		$("#btn_step1").removeClass("btn btn-success");
		$("#btn_step2").removeClass("btn btn-success");
		$("#btn_step3").removeClass("btn btn-success");
		$("#btn_step5").removeClass("btn btn-success");
		$("#btn_step6").removeClass("btn btn-success");
		
		$("#btn_step1").addClass("btn btn-secondary");
		$("#btn_step2").addClass("btn btn-secondary");
		$("#btn_step3").addClass("btn btn-secondary");
		$("#btn_step5").addClass("btn btn-secondary");
		$("#btn_step6").addClass("btn btn-secondary");
		
		$("#step4").show();
		$("#step1").hide();
		$("#step2").hide();
		$("#step3").hide();
		$("#step5").hide();
		$("#step6").hide();
		
	});
	
	$("#btn_step5").click(function(){
		$(this).addClass("btn btn-success");
		$("#btn_step1").removeClass("btn btn-success");
		$("#btn_step2").removeClass("btn btn-success");
		$("#btn_step3").removeClass("btn btn-success");
		$("#btn_step4").removeClass("btn btn-success");
		$("#btn_step6").removeClass("btn btn-success");
		
		$("#btn_step1").addClass("btn btn-secondary");
		$("#btn_step2").addClass("btn btn-secondary");
		$("#btn_step3").addClass("btn btn-secondary");
		$("#btn_step4").addClass("btn btn-secondary");
		$("#btn_step6").addClass("btn btn-secondary");
		
		$("#step5").slideToggle();
		$("#step5").show();
		$("#step1").hide();
		$("#step2").hide();
		$("#step3").hide();
		$("#step4").hide();
		$("#step6").hide();
		
	});
	
	$("#btn_step6").click(function(){
		$(this).addClass("btn btn-success");
		$("#btn_step1").removeClass("btn btn-success");
		$("#btn_step2").removeClass("btn btn-success");
		$("#btn_step3").removeClass("btn btn-success");
		$("#btn_step4").removeClass("btn btn-success");
		$("#btn_step5").removeClass("btn btn-success");
		
		$("#btn_step1").addClass("btn btn-secondary");
		$("#btn_step2").addClass("btn btn-secondary");
		$("#btn_step3").addClass("btn btn-secondary");
		$("#btn_step4").addClass("btn btn-secondary");
		$("#btn_step5").addClass("btn btn-secondary");
		
		$("#step6").slideToggle();
		$("#step6").show();
		$("#step1").hide();
		$("#step2").hide();
		$("#step3").hide();
		$("#step4").hide();
		$("#step5").hide();
		
	});
	
	
	$("#textbxans").focus(function(){
		$("#lblstatus").text("");
	});

  
}); 
  
	


</script>