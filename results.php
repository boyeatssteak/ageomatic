<?php require('header.php'); ?>
<?php require('functions.php'); ?>
<?php
	if($bday > $now) { // if user inputs $bday as later than current date/time
		echo "<h3>Oh dear me...</h3>";
		echo "<p>It appears that you've discovered time travel, and were born at some point after what my associates and I frequently refer to as &quot;now&quot;. If you don't remember traveling through time, perhaps you would you care to <a href='index.php'>enter another date</a>?</p>";
		echo "<style type='text/css'>#age { display: none; }</style>"; // hides results since they would not be accurate
		echo "<p>You selected " . $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') . ".</p>";
	}
?>
<h6>NOTE: I have not yet made the necessary updates to accommodate timezones in this revision, so for the time being, you'll need to make manual adjustments to the data submitted or retrieved to accommodate for your start and current location timezones. My server is in the Pacific timezone, where it is currently <?php echo $now->format('F j, Y h:i:sa') ?></h6>
<div id="age">
	<h3 class="age"><strong><?php echo $bday->age($now, '3', $secsIn); ?></strong> old</h3>
	<p>Age calculated on <?php echo $now->format('F j, Y') . " at " . $now->format('h:i:sa') ?> from a start date of <?php echo $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') ?>.</p>
	<h6>Not the right info? You can <a href="index.php">start over here</a>.</h6>
	<p>Inconvenient units abound!</p>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
</div><!-- #age -->
<div id="dates">
	<h3>(IN)SIGNIFICANT DATES</h3>
	<p>For no reason in particular, you can also see some dates and their associated significant quantities of units after your selected start date.</p>
	<h6>Current significant quantities are 
	<?php
		for($i = 0; $i < count($funIncs); $i++) {
			if($i == (count($funIncs)-1)) {
				echo "and " . number_format($funIncs[$i]);
			} else {
				echo number_format($funIncs[$i]) . ", ";
			}
		}
	?>
	. You can <a href="http://www.letterxdesign.com/contact.html">let me know</a> if you think I've missed any noteworthy quantities</h6>
	<form method="GET" action="">
		<label for="in">Show me this ridiculousness in</label>
		<select id="in" name="in">
			<?php
				for($i = 0; $i < count($secsIn); $i++) {
					echo "<option value='" . $i . "'>" . $secsIn[$i][1] . "s</option>";
				}
			?>
		</select>
		<input id="bday" name="bday" type="hidden" value="<?php echo $_GET ['bday']; ?>">
		<input id="time" name="time" type="hidden" value="<?php echo $_GET ['time']; ?>">
		<input id="thisMany" name="thisMany" type="hidden" value="<?php echo $_GET ['thisMany']; ?>">
		<button type="submit" name="inSelector">&#10148;</button>
		
	</form>
	<table>
		<tbody>
			<?php
				if(!empty($_GET['in'])) {
					$in = ($_GET['in']);
					for ($i = 0; $i < count($funIncs); $i++) {
						$dateArray = $bday->dateAfter($funIncs[$i], $in, $daysIn, $secsIn);
						echo "<tr><td>You " . $dateArray[1] . " <strong>" . number_format($funIncs[$i]) . " " . $secsIn[$in][1] . "s</strong> old on " . $dateArray[0] . "</td></tr>";
					}
				}
			?>
		</tbody>
	</table>
</div><!-- #dates -->
<div id="favorite">
	<h3>HAVE A FAVORITE NUMBER?</h3>
	<p>If you'd like the date and time a certain number of somethings from your start date, just type in that number here:</p>
	<form method="GET" action="">
		<label for="thisMany">Drumroll please:</label>
		<input type="text" id="thisMany" name="thisMany" required>
		<input id="bday" name="bday" type="hidden" value="<?php echo $_GET ['bday']; ?>">
		<input id="time" name="time" type="hidden" value="<?php echo $_GET ['time']; ?>">
		<input id="in" name="in" type="hidden" value="<?php echo $_GET ['in']; ?>">
		<button type="submit" name="customDay">My Favorite!</button>
	</form>
	<?php 
	$thisManyActual = $_GET['thisMany'];
	if ($thisManyActual != 0) {
		if ($thisManyActual < 1) {
			echo "<p>Really? Your favorite number is " . $thisManyActual . "? Come on... you gotta pick a number greater than 1.</p>";
		} else {
			$thisMany = round($_GET['thisMany']);
			echo "<table><tbody>";
			if ($thisMany != 1) {
				for ($i = 0; $i < count($daysIn); $i++) {
					$dateArray = $bday->dateAfter($thisMany, $i, $daysIn, $secsIn);
					echo "<tr><td>You " . $dateArray[1] . " <strong>" . number_format($thisMany, 0, ".", ",") . " " . $secsIn[$i][1] . "s</strong> old on " . $dateArray[0] . "</td>";
				}
			} else {
				for ($i = 0; $i < count($daysIn); $i++) {
					$dateArray = $bday->dateAfter($thisMany, $i, $daysIn, $secsIn);
					echo "<tr><td>You " . $dateArray[1] . " <strong>" . number_format($thisMany, 0, ".", ",") . " " . $secsIn[$i][1] . "</strong> old on " . $dateArray[0] . "</td>";
				}
			}
			echo "</tbody></table>";
		}
	}
	?>
</div><!-- #favorite -->
<?php require('footer.php'); ?>