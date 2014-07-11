<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>age-o-matic</title>
<meta name="description" content="Find out your age in seconds, minutes, days, weeks, hours, months or years. Pick a favorite number, and see when you'll be that many days old." />
<link rel="Shortcut Icon" type="image/ico" href="calc.ico" />
<link rel="image_src" href="calc.png" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style type="text/css">
html, body {font-family: Helvetica, Arial, sans-serif; width: 95%; max-width: 960px; margin: 5px auto;}
#body {margin-left: 225px;}
h3 {margin: 30px 0 0 0;}
h6 {margin: 0;}
p {margin: 10px 0 5px 0;}
@media only screen and (max-device-width : 430px), only screen and (max-width : 430px) {
	#body {margin-left: 0px; clear: both;}
}
</style>
<!-- BEGIN GOOGLE ANALYTICS TRACKING CODE -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15847880-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- END GOOGLE ANALYTICS TRACKING CODE -->
</head>
<body>
	<img style="float: left;" src="calc.png" alt="Age Calculator" />
	<div id="body">
	<h1>AGE-O-MATIC Age Calculator</h1>
	<h3>HOW OLD</h3>
	<p>Tell me when you were born, and I'll tell you how many somethings old you are.</p>
	<form id="number" method="GET" action="results.php">
		<label for="bday">Birthday:</label>
    <input id="bday" name="bday" type="date" required>
    <label for="time">Time:</label>
    <input id="time" name="time" type="time" step=any value="12:00:30">
		<input type="submit" value="Submit">
	</form>
	</div><!-- #body -->
</body>
</html>