<?php session_start();
include("connection.php");
$uid_session = $_SESSION["uid_session"];


$qid = $_POST['qid'];
$totalqid = $_POST['totalqid'];
$noOfQuestions = $_POST['noOfQuestions'];


if($totalqid == 0)
{
	$totalqid = $qid;
}	
else
{
	$totalqid = $totalqid.",".$qid;
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
	
}
else 
{
	$status = "Wrong";
}	

$qid = $qid+1;
$noOfQuestions = $noOfQuestions + 1;


/*$ins = "Insert into useranswer(qid,pid,uid,useranswer,status) values('$qid','$pid',
'$uid_session','$answ','$status')";	
if(mysqli_query($con, $ins))
{
}
else
{	
}*/


$sel3="select qid,question,hint,qinfo from questions where caseid='$caseid' and qid='$qid'";
$rel3=$con->query($sel3);
$data3 = mysqli_fetch_assoc($rel3);


$qid = $data3['qid'];


$question = html_entity_decode($data3['question'],ENT_QUOTES,"UTF-8");
$hint = html_entity_decode($data3['hint'],ENT_QUOTES,"UTF-8");
$qinfo = html_entity_decode($data3['qinfo'],ENT_QUOTES,"UTF-8");


/*if (preg_match_all('/"/', $data3['question']))
{
	$question = htmlspecialchars_decode($data3['question']);
}
else
{
	$question = htmlentities($data3['question']);
}

if (preg_match_all('/"/', $data3['hint']))
{
	$hint = htmlspecialchars_decode($data3['hint']);
}
else
{
	$hint = htmlentities($data3['hint']);
}

if (preg_match_all('/"/', $data3['qinfo']))
{
	$qinfo = htmlspecialchars_decode($data3['qinfo']);
}
else
{
	$qinfo = htmlentities($data3['qinfo']);
}*/


$output["qid"] = $qid;
$output["question"] = $question;
$output["hint"] = $hint;
$output["qinfo"] = $qinfo;

$output['totalqid']= $totalqid;
$output['noOfQuestions']= $noOfQuestions;
$output['status']= $status;

echo json_encode($output);

?>




