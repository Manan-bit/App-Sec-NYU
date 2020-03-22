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
  $status = "Paused:".$textbxqid_name;
  
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
    <title>Practical Forensics 101</title>
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
			
			<div class="col-md-12">
				<h5><label style="font-size:25px;" id="lblpts" style="margin-top: 2%;">50</label> Points</h5>
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
				  <input type="hidden" id="caseid" class="form-control" value="<?php echo $caseid ?>" />
				  <input type="hidden" id="points" class="form-control" value="50" />
				  
				  
				  <div class="col-md-12 divmarg" style="margin-top:8%;">
					<button type="button" class="btn btn-primary btn_next" id="btnnext" value="<?php echo $qid ?>" data-id="<?php echo $caseid ?>">Submit</button>				
					<!--<button type="button" style="margin-left:5%;" class="btn btn-success btn_end" id="btnend" value="<?php //echo $qid ?>" data-id="<?php //echo $caseid ?>">End Test</button>-->
					<button type="button" class="btn_skip btnskip" id="btnskip" value="<?php echo $qid ?>" data-id="<?php echo $caseid ?>">Skip</button>
				  </div>
				  
				  <div class="col-md-12 divmarg" style="margin-top:3%;">
					<p id="qinfo"><?php echo $qinfo ?></p>				
				  </div>

				  
				</div>
				
				<div class="col-md-6 divmarg" style="border: 1px solid #d0d0d0;">
					<h4><b>Case Details :</b></h4>
					
					<div class="col-md-6 divmarg">
						<label>Case Name : <span style="font-size: 17px; font-weight: normal;"><?php echo $casename ?></span></label>
					</div>
										
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
						
						<div class="tab-pane fade in col-md-12 divmarg" style="margin-top:3%;" id="Evidence">
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
			

<?php


include('footer.php') ?>

<script type="text/javascript">

// set minutes
var mins = document.getElementById("minutes").value;
var secs_val = document.getElementById("seconds").value;

var caseid = document.getElementById("caseid").value;
var points = document.getElementById("points").value;

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
	var t_points = $("#points").val();
	
	
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
					window.location.href="ViewResult_Practice.php?casetype="+casetype+"&timeup=0&pid="+pid+"&caseid="+caseid+"&points="+t_points;	
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
	
	var t_points = $("#points").val();
	var t_pts  = parseInt(t_points - 5);
	$("#points").val(t_pts);
	
	$("#btn_hint").hide();
	
  });

  
$('.btn_next').click(function(){

	 var id = $(this).attr("value");
	 var caseid = $(this).attr("data-id");
	 var answ = $("#textbxans").val();
	 var pid = $("#textbxpid").val();
	 var totalqid = $("#textbxqid").val();
	 var totalqid = $("#textbxqid").val();	 	 
	 var pid = $("#textbxpid").val();
	 var casetype = $("#casetype").val();
	 var countquestions = $("#countquestions").val();
	 var noOfQuestions = $("#noOfQuestions").val();
	 var t_points = $("#points").val();
	 var totalpts = "";
	 var pts = "";
	 
	 
	 $("#hint_div").slideUp();
	 
	 if(t_points == 0)
	 {
		pts = 5;
		$("#btn_hint").hide();

	 }
	 else if(t_points > 0)
	 {
		pts = 10;
		$("#btn_hint").show();
	 }
	 
	 
	 if(answ == "")
	 {
		alert("Please Enter an Answer");
		$("#hint_div").slideUp();
	 }
	 else
	 {		 
		 $.ajax({
			url:"StartCase_questP.php",
			method:"POST",
			data:{totalqid:totalqid,qid:id,caseid:caseid,answ:answ,pid:pid,noOfQuestions:noOfQuestions},
			dataType:"json",
			success:function(data)
			{
				//console.log(data);
				
				if(data.status == "Right")
				{
					totalpts = parseInt(t_points) + parseInt(pts);
					$("#points").val(totalpts);
						
					alert("This is the Right Answer");
				}
				else if(data.status == "Wrong")
				{
					totalpts = t_points;
					$("#points").val(totalpts);
						
					alert("This is the Wrong Answer");
				}
					
				$("#lblpts").text(totalpts);
				
					
				if(data.qid == null || data.qid == "")
				{
					//window.location.href="ViewResult.php?casetype="+casetype+"&quest=done&pid="+pid;
					window.location.href="ViewResult_Practice.php?casetype="+casetype+"&quest=done&pid="+pid+"&caseid="+caseid+"&points="+t_points;
				}
				else
				{				
					$("#btnnext").val(data.qid);
					$("#btnskip").val(data.qid);	
					$("#textbxquest").text(data.question);
					$("#hint_div").text(data.hint);
					$("#qinfo").text(data.qinfo);
					$("#textbxqid").val(data.totalqid);
					$("#noOfQuestions").val(data.noOfQuestions);						
					$("#textbxans").val("");
										
															
					var totalpercnt = (noOfQuestions/countquestions)*100;
					$("#progressbar_val").val(totalpercnt);
						
					progress();
										
				}
					
			}
			
		 });
	 }	 
   
  });
  
  
  
  $('.btn_skip').click(function(){

	 var id = $(this).attr("value");
	 var caseid = $(this).attr("data-id");
	 var answ = $("#textbxans").val();
	 var pid = $("#textbxpid").val();
	 var totalqid = $("#textbxqid").val();	 	 
	 var pid = $("#textbxpid").val();
	 var casetype = $("#casetype").val();
	 var countquestions = $("#countquestions").val();
	 var noOfQuestions = $("#noOfQuestions").val();	
	 var t_points = $("#points").val();	
	 
	 
	 $("#hint_div").slideUp();
	 
		 
		 $.ajax({
			url:"StartCase_questP.php",
			method:"POST",
			data:{totalqid:totalqid,qid:id,caseid:caseid,answ:answ,pid:pid,noOfQuestions:noOfQuestions},
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				if(data.qid == null || data.qid == "")
				{
					//window.location.href="ViewResult.php?casetype="+casetype+"&quest=done&pid="+pid;
					window.location.href="ViewResult_Practice.php?casetype="+casetype+"&quest=done&pid="+pid+"&caseid="+caseid+"&points="+t_points;
				}
				else
				{
					$("#btnnext").val(data.qid);	
					$("#btnskip").val(data.qid);				
					$("#textbxquest").text(data.question);
					$("#hint_div").text(data.hint);
					$("#qinfo").text(data.qinfo);									
					
					$("#textbxqid").val(data.totalqid);
					$("#noOfQuestions").val(data.noOfQuestions);						
					$("#textbxans").val("");
						
					var totalpercnt = (noOfQuestions/countquestions)*100;
					$("#progressbar_val").val(totalpercnt);
						
					progress();
										
				}
					
			}
			
		 });
	 
   
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
		
  
}); 
  
	


</script>