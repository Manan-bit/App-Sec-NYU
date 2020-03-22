
<div class="text-right footer">
	<p class="footerp">Practical Forensics 101</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="js/jquery.validate.min.js"></script>


<script>

$(function() {
  $('li a[href^="' + location.pathname.split("/")[2] + '"]').addClass('active');			
});

var url = location.pathname.split("/")[2];
  if (url == 'ViewCase.php' || url == 'StartCase.php' || url == 'ViewResult.php') {              
    $('.ones').addClass('active');
  }
  

</script>

</body>
</html>
