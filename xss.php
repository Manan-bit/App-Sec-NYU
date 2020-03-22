<h1>
	Application Security Assignment 2
</h1>

<h4>

Simple XSS

</h4>


<form action="action_post.php" method="post">
 <input type="text" name="comment" value="">
 <input type="submit" name="submit" value="Submit">
</form>

<input type="button" onclick="window.location='practical forensic/'" class="Redirect" value="Click Here To try SQLi"/>
