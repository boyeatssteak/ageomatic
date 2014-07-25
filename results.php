<?php require('header.php'); ?>
	<?php
		if(empty($_GET['name'])) {
			$name = "It";
		} else {
			$name = $_GET['name'];
		}
		if($bday > $now) { // if user inputs $bday as later than current date/time
			echo "<h3>Oh dear me...</h3>";
			echo "<p>It appears that you've discovered time travel, and were born at some point after what my associates and I frequently refer to as &quot;now&quot;. If you don't remember traveling through time, perhaps you would you care to <a href='index.php'>enter another date</a>?</p>";
			echo "<style type='text/css'>#age { display: none; }</style>"; // hides results since they would not be accurate
			echo "<p>You selected " . $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') . ".</p>";
		}
	?>
</div>
<div id="age">
	<h3 class="age"><?php echo $name . " is <strong>" . $bday->age($now, $in, $secsIn); ?></strong> old</h3>
	<p>Age calculated on <?php echo $now->format('F j, Y') . " at " . $now->format('h:i:sa') ?> from a start date of <?php echo $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') ?>.</p>
	<h6>Not the right info? You can <a href="index.php">start over here</a>.</h6>
	<p>Inconvenient units abound! <?php echo $name; ?> is...</p>
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
	<h3>COMING SOON</h3>
	<p>For no reason in particular, you can also see the upcoming dates where <?php echo $name; ?> will be some significant number of <?php echo $secsIn[$in][1]; ?>s old.</p>
	<form method="GET" action="#dates">
		<input id="name" name="name" type="hidden" value="<?php echo $_GET ['name']; ?>">
		<input id="bday" name="bday" type="hidden" value="<?php echo $_GET ['bday']; ?>">
		<input id="time" name="time" type="hidden" value="<?php echo $_GET ['time']; ?>">
		<label for="in">Show me this ridiculousness in</label>
		<select id="in" name="in">
			<!-- <option value="-1">Select</option> -->
			<?php
				for($i = 0; $i < count($secsIn); $i++) {
					echo "<option value='" . $i . "'>" . $secsIn[$i][1] . "s</option>";
				}
			?>
		</select>
		<input id="thisMany" name="thisMany" type="hidden" value="<?php echo $_GET ['thisMany']; ?>">
		<button type="submit">&#10148;</button>
	</form>
	<table>
		<tbody>
			<?php
				if($in >= 0 && $in <= 6) {
					$unitsOld = $bday->ageNumOnly($now, $in, $secsIn);
					$i = 0;
					do {
						$i++;
					} while ($funIncs[$i] < $unitsOld);
					$n = $i + 3;
					do {
						$dateArray = $bday->dateAfter($funIncs[$i], $in, $daysIn, $secsIn);
						echo "<tr><td>" . $name . " " . $dateArray[1] . " <strong>" . number_format($funIncs[$i]) . " " . $secsIn[$in][1] . "s</strong> old on " . $dateArray[0] . "</td></tr>";
						$i++;
					} while ($i < $n && $i < count($funIncs));
				};
			?>
		</tbody>
	</table>
</div><!-- #dates -->
<div id="favorite">
	<h3>HAVE A FAVORITE NUMBER?</h3>
	<p>If you'd like the date and time a certain number of somethings from your start date, just type in that number here:</p>
	<form method="GET" action="#favorite">
		<input id="name" name="name" type="hidden" value="<?php echo $_GET ['name']; ?>">
		<input id="bday" name="bday" type="hidden" value="<?php echo $_GET ['bday']; ?>">
		<input id="time" name="time" type="hidden" value="<?php echo $_GET ['time']; ?>">
		<input id="in" name="in" type="hidden" value="<?php echo $_GET ['in']; ?>">
		<label for="thisMany">Drumroll please:</label>
		<input type="tel" id="thisMany" name="thisMany" required>
		<button type="submit">My Favorite!</button>
	</form>
	<?php 
	$thisManyActual = $_GET['thisMany'];
	if ($thisManyActual != 0) {
		if ($thisManyActual < 1 || $thisManyActual > 100000000000) {
			echo "<p>Really? Your favorite number is " . $thisManyActual . "? Come on... you gotta pick a number between 1 and 100,000,000,000.</p>";
		} else {
			$thisMany = round($_GET['thisMany']);
			echo "<table><tbody>";
			if ($thisMany != 1) {
				for ($i = 0; $i < count($daysIn); $i++) {
					$dateArray = $bday->dateAfter($thisMany, $i, $daysIn, $secsIn);
					echo "<tr><td>" . $name . " " . $dateArray[1] . " <strong>" . number_format($thisMany, 0, ".", ",") . " " . $secsIn[$i][1] . "s</strong> old on " . $dateArray[0] . "</td>";
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