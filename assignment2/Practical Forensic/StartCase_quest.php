<?php session_start();

include("connection.php");
$uid_session = $_SESSION["uid_session"];


$qid = $_POST['qid'];
$totalqid = $_POST['totalqid'];
$noOfQuestions = $_POST['noOfQuestions'];
$counter_wrong = $_POST['counter_wrong'];


if($totalqid == 0)
{
	$totalqid = $qid;
}	
else
{
	$totalqid = $totalqid.",".$qid;
}


if($counter_wrong == 3)
{
	$counter_wrong = $counter_wrong;
}
else
{
	$counter_wrong = $counter_wrong + 1;
}	


$caseid = $_POST['caseid'];
$answ = $_POST['answ'];
$pid = $_POST['pid'];
$status = "";


$sel4="select answer from questions where caseid='$caseid' and qid='$qid'";
$rel4=$con->query($sel4);
$data4 = mysqli_fetch_assoc($rel4);
$answ_data = $data4['answer'];

if(strtolower(trim($answ)) == strtolower(trim($answ_data)))
{
	$status = "Right";
	$qid = $qid+1;
	$noOfQuestions = $noOfQuestions + 1;
}
else 
{
	$status = "Wrong";
	$qid = $qid;
	$noOfQuestions = $noOfQuestions;
}	


/*$ins = "Insert into useranswer(qid,pid,uid,useranswer,status) values('$qid','$pid',
'$uid_session','$answ','$status')";	
if(mysqli_query($con, $ins))
{
}
else
{	
}*/


$sel3="select qid,question,hint,qinfo,step1,step2,step3,step4,step5,step6 from questions where caseid='$caseid' and qid='$qid'";
$rel3=$con->query($sel3);
$data3 = mysqli_fetch_assoc($rel3);


$qid = $data3['qid'];

$question = html_entity_decode($data3['question'],ENT_QUOTES,"UTF-8");
$hint = html_entity_decode($data3['hint'],ENT_QUOTES,"UTF-8");
$qinfo = html_entity_decode($data3['qinfo'],ENT_QUOTES,"UTF-8");
$step1 = html_entity_decode($data3['step1'],ENT_QUOTES,"UTF-8");
$step2 =  html_entity_decode($data3['step2'],ENT_QUOTES,"UTF-8");
$step3 =  html_entity_decode($data3['step3'],ENT_QUOTES,"UTF-8");
$step4 =  html_entity_decode($data3['step4'],ENT_QUOTES,"UTF-8");
$step5 =  html_entity_decode($data3['step5'],ENT_QUOTES,"UTF-8");
$step6 =  html_entity_decode($data3['step6'],ENT_QUOTES,"UTF-8");

/*$question = htmlentities($data3['question']);
$hint = htmlentities($data3['hint']);
$qinfo = htmlentities($data3['qinfo']);
$step1 = htmlentities($data3['step1']);
$step2 =  htmlentities($data3['step2']);
$step3 =  htmlentities($data3['step3']);
$step4 =  htmlentities($data3['step4']);
$step5 =  htmlentities($data3['step5']);
$step6 =  htmlentities($data3['step6']);*/


$output["qid"] = $qid;
$output["question"] = $question;
$output["hint"] = $hint;
$output["qinfo"] = $qinfo;
$output['step1']= $step1;
$output['step2']= $step2;
$output['step3']= $step3;
$output['step4']= $step4;
$output['step5']= $step5;
$output['step6']= $step6;

$output['totalqid']= $totalqid;
$output['noOfQuestions']= $noOfQuestions;
$output['counter_wrong']= $counter_wrong;
$output['status']= $status;

echo json_encode($output);

?>




