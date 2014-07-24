<?php require('header.php'); ?>
<p>Tell me when something started (e.g. your birthday), and I'll tell you how many somethings old it is.</p>
<form id="number" method="GET" action="results.php">
	<label for="bday">Date:</label>
	<input id="bday" name="bday" type="date" required>
	<label for="time">Time:</label>
	<input id="time" name="time" type="time" step=any value="12:00:30">
	<input id="in" name="in" type="hidden">
	<input id="thisMany" name="thisMany" type="hidden" value="0">
	<input type="submit" value="Submit">
</form>
<?php require('footer.php'); ?>