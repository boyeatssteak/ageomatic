<?php require('header.php'); ?>
<p>Tell me when something started (e.g. your birthday), and I'll tell you how many somethings old it is.</p>
<form id="start" method="GET" action="results.php" style="margin-left: 50px;">
	<label for="name">Thing Name (optional):</label>
	<input id="name" name="name" type="text"><br />
	<label for="bday">Date:</label>
	<input id="bday" name="bday" type="date" required><br />
	<label for="time">Time:</label>
	<input id="time" name="time" type="time" step=any value="12:00:30"><br />
	<label for="in">Favorite Units:</label>
	<select id="in" name="in">
		<option value="-1">Select</option>
		<?php
			for($i = 0; $i < count($secsIn); $i++) {
				if($i == 3) {
					echo "<option value='" . $i . "' selected>" . $secsIn[$i][1] . "s</option>";
				} else {
					echo "<option value='" . $i . "'>" . $secsIn[$i][1] . "s</option>";
				}
			}
		?>
	</select>
	<input id="thisMany" name="thisMany" type="hidden" value="0">
	<button type="submit">Tell Me!</button>
</form>
<?php require('footer.php'); ?>