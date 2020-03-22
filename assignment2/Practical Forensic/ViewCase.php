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

<form method="post">

	<div class="col-md-12 col-lg-12 divmarg">						
		<ul class="nav nav-tabs" id="myTab_cases">
				<li class="active"><a href="#newcase">New Cases</a></li>
				<li><a href="#pausecase">Paused Cases</a></li>
				<li><a href="#finishedcase">Finished Cases</a></li>
				<li><a href="#incompcase">Incomplete Cases</a></li>
		</ul>
	</div>
					
		<!--<div class="col-md-12 divmarg">	
			<div class="col-md-12 text-right">
				<div class="col-md-10">
					<h4>Sort By</h4>
				</div>
				<div class="col-md-2">
					<select id="drpdwn" class="form-control">
						<option value="newcase">New Cases</option>
						<option value="pausecase">Paused Cases</option>
						<option value="finishedcase">Finished Cases</option>
						<option value="incompcase">Incomplete Cases</option>
					</select>
				</div>
			</div>-->
			
			
	<div class="tab-content">		
			<div class="tab-pane fade in active col-md-12 divdrp" id="newcase">
				<div class="col-md-12">
					<h3>New Cases :</h3>
				</div>
				
				<table class="table table-bordered table-hover">
			
				<?php
				$sel = "select caseid,casename,time,date from cases WHERE caseid NOT IN (SELECT caseid FROM caseprocess where uid='$uid_session') and casetype='$casetype'";
				//$sel = "select caseid,casename,time,date from cases where casetype='$casetype'";
				$rel=$con->query($sel);
							
				if(mysqli_num_rows($rel)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{					
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
					<tr>	
					<th>Case Name</th>				
					<th>Time</th>
					<th>Date</th>
					<th>Action</th>			
					</tr>
					</thead>

					<tbody>';
					
					
					while($data=mysqli_fetch_array($rel))
					{
						$caseid=$data['caseid'];
						$casename=$data['casename'];	
						$time=$data['time'];
						$date=$data['date'];						
						
						echo'<tr>
						<td>'.$casename.'</td>
						<td>'.$time.'</td>
						<td>'.$date.'</td>	
						<td><a href="ViewCase_Check.php?casetype='.$casetype.'&caseid_new='.$caseid.'" class="btn btn-primary" style="width:40%;">Start</a></td>
						</tr>';	
						
					}
					
					echo'</tbody></table>';						
				}
												
				?>
							 
				
			  </table>
			  
		</div>
		
		<div class="tab-pane fade in col-md-12 divdrp" id="pausecase">
				<div class="col-md-12">
					<h3>Paused Cases :</h3>
				</div>
				
				<?php
				
				/*$sel3 ="select count(u.pid) as countpid,cp.pid,c.caseid,c.casename,cp.timer,cp.date from cases as c join caseprocess as cp on c.caseid=cp.caseid join useranswer as u on u.pid=cp.pid where cp.status like 'P%' and cp.uid='$uid_session'";
				$rel3=$con->query($sel3);
				$data2 = mysqli_fetch_assoc($rel3);
				$data[] = $data2;
			
				if(mysqli_num_rows($rel3)==1)
				{							
					$no = $data[0]['countpid'];					
				}
				else
				{					
					$no = 1;
				}
								
				if(mysqli_num_rows($rel3)==0 || $no == 0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{
					
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
					<tr>	
					<th>Case Name</th>				
					<th>Time Remaining</th>
					<th>Last Played On</th>
					<th>Attempted Questions</th>
					<th>Action</th>		
					</tr>
					</thead>

					<tbody>';
									
					foreach($data as $row){
					
						$countpid = $row['countpid'];
						$caseid = $row['caseid'];
						$casename = $row['casename'];
						$timer = $row['timer'];
						$date= $row['date'];
						$pid= $row['pid'];
						
						
						echo'<tr>
						<td>'.$casename.'</td>
						<td>'.$timer.'</td>
						<td>'.$date.'</td>
						<td>'.$countpid.'</td>		
						<td><a href="StartCase.php?btnstate=continue&caseid='.$caseid.'&pid='.$pid.'&casetype='.$casetype.'" class="btn btn-primary" style="width:60%;">Continue</a></td>
						</tr>';	
						
					}
					
					echo'</tbody></table>';						
				}*/
				
				
				
				$sel3 ="select cp.pid,c.caseid,c.casename,cp.timer,cp.date from cases as c join caseprocess as cp on c.caseid=cp.caseid where cp.status like 'P%' and cp.uid='$uid_session' and c.casetype='$casetype'";
				$rel3=$con->query($sel3);
							
				if(mysqli_num_rows($rel3)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{
					
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
					<tr>	
					<th>Case Name</th>				
					<th>Time Elapsed</th>
					<th>Last Played On</th>
					<th>Attempted Questions</th>
					<th>Action</th>		
					</tr>
					</thead>

					<tbody>';
									
					while($row=mysqli_fetch_array($rel3))
					{					
						$caseid = $row['caseid'];
						$casename = $row['casename'];
						$timer = $row['timer'];
						$date= $row['date'];
						$pid= $row['pid'];
						
						$sel_countpid ="select count(pid) as countpid from useranswer where pid='$pid'";
						$rel_countpid=$con->query($sel_countpid);
						$data_countpid = mysqli_fetch_assoc($rel_countpid);
						$countpid = $data_countpid['countpid'];
						
						
						echo'<tr>
						<td>'.$casename.'</td>
						<td>'.$timer.'</td>
						<td>'.$date.'</td>
						<td>'.$countpid.'</td>';
						
						if($casetype == "For Practice")
						{
							echo'<td><a href="StartCase.php?btnstate=continue&caseid='.$caseid.'&pid='.$pid.'&casetype='.$casetype.'" class="btn btn-primary" style="width:60%;">Continue</a></td>';
						}
						else if($casetype == "For Game")
						{
							echo'<td><a href="StartCase_Game.php?btnstate=continue&caseid='.$caseid.'&pid='.$pid.'&casetype='.$casetype.'" class="btn btn-primary" style="width:60%;">Continue</a></td>';
						}
										
						echo'</tr>';							
					}
					
					echo'</tbody></table>';						
				}
				
				?>
				
				
		</div>
			
		<div class="tab-pane fade in col-md-12 divdrp" id="finishedcase">
				<div class="col-md-12">
					<h3>Finished Cases :</h3>
				</div>
				<?php
				
				/*$sel3 ="select pid,caseid from caseprocess where status='Finished' and uid='$uid_session'";
				$rel3=$con->query($sel3);
				if(mysqli_num_rows($rel3)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{
					$caseid = array();
					$casename = array();
					$time = array();
					$date = array();
					
					while($data2=mysqli_fetch_array($rel3))
					{
						$caseid_array_f[] = $data2['caseid'];
						$pid_array_f[] = $data2['pid'];	
					}
					
					$count_caseid1 = count($pid_array_f);
					
					$finishedcases = "";
					
					for($k = 0; $k < $count_caseid1; $k++)
					{
						$sel4 ="select caseid,casename,time,date from cases where casetype like '%$casetype%' and caseid = '$caseid_array_f[$k]'";					
						$rel4=$con->query($sel4);
						if(mysqli_num_rows($rel4)==0)
						{			  
							$finishedcases = "norecords";					
						}
						else
						{
							while($data3=mysqli_fetch_array($rel4))
							{
								$caseid[] = $data3['caseid'];	
								$casename_array[] = $data3['casename'];
								$time[] = $data3['time'];
								$date[] = $data3['date'];							
							}
						}											
					}
					
					if($finishedcases != "norecords")
					{									
						$count_casename1 = count($casename_array);

						echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
						<tr>	
						<th>Case Name</th>				
						<th>Time</th>
						<th>Date</th>
						<th>Action</th>		
						</tr>
						</thead>

						<tbody>';	

						for($l = 0; $l < $count_casename1; $l++)
						{
							echo'<tr>
							<td>'.$casename_array[$l].'</td>
							<td>'.$time[$l].'</td>
							<td>'.$date[$l].'</td>						
							<td><a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid[$l].'" class="btn btn-primary" style="width:40%;">Start Again</a></td>
							</tr>';						
						}	
						echo'</tbody></table>';
					}
					else
					{
						echo "<center><h3>No records to display</h3></center>";	
					}
				}*/
				
				
				
				/*$sel3 ="select Distinct cp.caseid,cp.status,c.casename,c.time,c.date from caseprocess as cp join cases as c on c.caseid = cp.caseid where cp.status='Finished' and cp.uid='$uid_session'";
				$rel3=$con->query($sel3);
				if(mysqli_num_rows($rel3)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{										
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
						<tr>	
						<th>Case Name</th>				
						<th>Time</th>
						<th>Date</th>
						<th>Action</th>		
						</tr>
						</thead>

						<tbody>';	
					
						while($data3=mysqli_fetch_array($rel3))
						{
							$caseid = $data3['caseid'];	
							$casename = $data3['casename'];
							$time = $data3['time'];
							$date = $data3['date'];
							$status = $data3['status'];	

							$sel_status ="select count(status) as status from caseprocess where caseid='$caseid' and status='Incomplete' and uid='$uid_session'";
							$rel_status=$con->query($sel_status);
							$data_status=mysqli_fetch_assoc($rel_status);
							$countstatus = $data_status['status'];
							
							if($countstatus == 0)
							{
								$k = 1;
								echo'<tr>
								<td>'.$casename.'</td>
								<td>'.$time.'</td>
								<td>'.$date.'</td>						
								<td><a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid.'" class="btn btn-primary" style="width:40%;">Start Again</a></td>
								</tr>';	
							}
							else
							{ 
								$k=0;
							}					
						}
												
					echo'</tbody></table>';
					
					if($k == 0)
					{
						echo "<center><h3>No records to display</h3></center>";	
					}					
					
				}*/
				
				
				$sel3 ="select Distinct cp.pid,cp.caseid,c.casename,c.time,c.date from caseprocess as cp join cases as c on c.caseid = cp.caseid where cp.status='Finished' and cp.uid='$uid_session' and c.casetype='$casetype'";
				$rel3=$con->query($sel3);
				if(mysqli_num_rows($rel3)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{										
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
						<tr>	
						<th>Case Name</th>				
						<th>Time</th>
						<th>Date</th>
						<th>Action</th>		
						</tr>
						</thead>

						<tbody>';	
					
						while($data3=mysqli_fetch_array($rel3))
						{
							$caseid = $data3['caseid'];	
							$casename = $data3['casename'];
							$time = $data3['time'];
							$date = $data3['date'];
							$pid = $data3['pid'];
															
							echo'<tr>
							<td>'.$casename.'</td>
							<td>'.$time.'</td>
							<td>'.$date.'</td>						
							<td><a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid.'&pid='.$pid.'" class="btn btn-primary" style="width:40%;">Start Again</a></td>
							</tr>';	
														
						}
						echo'</tbody></table>';	
				}
				
				?>
		</div>
	
		<div class="tab-pane fade in col-md-12 divdrp" id="incompcase">
				<div class="col-md-12">
					<h3>Incomplete Cases :</h3>
				</div>
				
				<?php
				
				/*$sel1 ="select pid,caseid from caseprocess where status='Incomplete' and uid='$uid_session'";
				$rel1=$con->query($sel1);
				if(mysqli_num_rows($rel1)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{
					$caseid = array();
					$casename = array();
					$time = array();
					$date = array();
					
					while($data1=mysqli_fetch_array($rel1))
					{
						$caseid[] = $data1['caseid'];
						$pid_array_i[] = $data1['pid'];		
					}
					
					$count_caseid = count($pid_array_i);
					
					$incompletecases = "";	
					
					for($i = 0; $i < $count_caseid; $i++)
					{
						$sel2 ="select caseid,casename,time,date from cases where casetype like '%$casetype%' and caseid = '$caseid[$i]'";					
						$rel2=$con->query($sel2);
						if(mysqli_num_rows($rel2)==0)
						{			  
							$incompletecases = "norecords";					
						}
						else
						{
							while($data2=mysqli_fetch_array($rel2))
							{
								$caseid[] = $data2['caseid'];	
								$casename[] = $data2['casename'];
								$time[] = $data2['time'];
								$date[] = $data2['date'];							
							}
						}						
					}
					
					if($incompletecases != "norecords")
					{
						$count_casename = count($casename);

						echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
						<tr>	
						<th>Case Name</th>				
						<th>Time</th>
						<th>Date</th>
						<th>Action</th>		
						</tr>
						</thead>

						<tbody>';	

						for($j = 0; $j < $count_casename; $j++)
						{
							echo'<tr>
							<td>'.$casename[$j].'</td>
							<td>'.$time[$j].'</td>
							<td>'.$date[$j].'</td>						
							<td><a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid[$j].'" class="btn btn-primary" style="width:40%;">Start Again</a></td>
							</tr>';						
						}	
						echo'</tbody></table>';	
				    }
					else
					{
						echo "<center><h3>No records to display</h3></center>";	
					}								
				}*/
				
				
				$sel1 ="select Distinct cp.pid,cp.caseid, c.casename,c.time,c.date from caseprocess as cp join cases as c on c.caseid = cp.caseid where cp.status='Incomplete' and cp.uid='$uid_session' and c.casetype='$casetype'";
				$rel1=$con->query($sel1);
				if(mysqli_num_rows($rel1)==0)
				{			  
					echo "<center><h3>No records to display</h3></center>";					
				}
				else
				{	
					echo'<table class="table table-bordered table-hover"><thead style="background-color:grey;color:white">           
					<tr>	
					<th>Case Name</th>				
					<th>Time</th>
					<th>Date</th>
					<th>Action</th>		
					</tr>
					</thead>

					<tbody>';	
					
					while($data2=mysqli_fetch_array($rel1))
					{
						$caseid = $data2['caseid'];	
						$casename = $data2['casename'];
						$time = $data2['time'];
						$date = $data2['date'];
						$pid = $data2['pid'];

						echo'<tr>
						<td>'.$casename.'</td>
						<td>'.$time.'</td>
						<td>'.$date.'</td>						
						<td><a href="ViewCase_Yes.php?casetype='.$casetype.'&caseid='.$caseid.'&pid='.$pid.'" class="btn btn-primary" style="width:40%;">Start Again</a></td>
						</tr>';						
								
						echo'</tbody></table>';	
					}
				    							
				}			
				
				?>				
			  			 			  
			</div>	
	</div>
	

</form>		
</div>		
</div>


<?php

if($_GET['casetype'] == "For Practice")
{
	if(!empty($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
		$date = date("Y-m-d");
		
		
		$ins = "Insert into caseprocess(caseid,uid,status,timer,date,type) values('$caseid',
		'$uid_session','','','$date','$casetype')";		
			
		if(mysqli_query($con, $ins))
		{
			$sel="select pid from caseprocess Order by pid desc Limit 1";
			$rel=$con->query($sel);
			$data = mysqli_fetch_assoc($rel);
			$pid = $data['pid'];
			
			echo "<script>alert('Your Case has been started');</script>";	
			echo "<script>window.location.href='StartCase.php?btnstate=&caseid_new=".$caseid."&pid=".$pid."&casetype=".$casetype."'</script>";
		}
		else
		{
			echo "<script>alert('Invalid');</script>";	
		}
		
	}
	else if(!empty($_GET['caseid']))
	{
		$caseid = $_GET['caseid'];
		$date = date("Y-m-d");
		$pid = $_GET['pid'];
		
			
		echo "<script>alert('Your Case has been started');</script>";	
		echo "<script>window.location.href='StartCase.php?btnstate=&caseid=".$caseid."&pid=".$pid."&casetype=".$casetype."'</script>";
		
	}
}
else if($_GET['casetype'] == "For Game")
{
	if(!empty($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
		$date = date("Y-m-d");
		
		
		$ins = "Insert into caseprocess(caseid,uid,status,timer,date,type) values('$caseid',
		'$uid_session','','','$date','$casetype')";		
			
		if(mysqli_query($con, $ins))
		{
			$sel="select pid from caseprocess Order by pid desc Limit 1";
			$rel=$con->query($sel);
			$data = mysqli_fetch_assoc($rel);
			$pid = $data['pid'];
			
			echo "<script>alert('Your Case has been started');</script>";	
			echo "<script>window.location.href='StartCase_Game.php?btnstate=&caseid_new=".$caseid."&pid=".$pid."&casetype=".$casetype."'</script>";
		}
		else
		{
			echo "<script>alert('Invalid');</script>";	
		}
		
	}
	else if(!empty($_GET['caseid']))
	{
		$caseid = $_GET['caseid'];
		$date = date("Y-m-d");
		$pid = $_GET['pid'];
		
			
		echo "<script>alert('Your Case has been started');</script>";	
		echo "<script>window.location.href='StartCase_Game.php?btnstate=&caseid=".$caseid."&pid=".$pid."&casetype=".$casetype."'</script>";
		
	}

}	


include('footer.php') 

?>

<script type="text/javascript">

 $("#myTab_cases a").click(function(e){
    	e.preventDefault();
    	$(this).tab('show');
    });
	

	/*$(document).ready(function () { 

        $('#pausecase').hide();
		$('#finishedcase').hide();
		$('#incompcase').hide();
		$('#newcase').show();

        $('#drpdwn').change(function(){
            $('.divdrp').hide();
            $('#' + $(this).val()).show();
        });

    });*/
	
</script>


