<?php require('header.php'); ?>
<p>Tell me when something started (e.g. your birthday), and I'll tell you how many somethings old it is.</p>
<form id="start" method="GET" action="results.php" style="margin-left: 50px;">
	<label for="name">Thing Name (optional):</label>
	<input id="name" name="name" type="text"><br />
	<label for="bday">Date:</label>
	<input id="bday" name="bday" type="date" required><br />
	<label for="time">Time:</label>
	<input id="time" name="time" type="time" step=any value="12:00:30"><br />
	<input id="in" name="in" type="hidden">
	<input id="thisMany" name="thisMany" type="hidden" value="0">
	<button type="submit">Tell Me!</button>
</form>
<?php require('footer.php'); ?>