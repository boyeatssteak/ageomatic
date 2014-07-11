<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>age-o-matic</title>
<meta name="description" content="Find out your age in seconds, minutes, days, weeks, hours, months or years. Pick a favorite number, and see when you'll be that many days old." />
<link rel="Shortcut Icon" type="image/ico" href="calc.ico" />
<link rel="image_src" href="calc.png" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
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
<?php
$bday = new Birthday ($_GET ['bday'] . " " . $_GET ['time']); //assigns user input to a DateTime object
$now = new DateTime ("now"); // creates a new DateTime object for the current time/date
$secsIn = array( // quantity of seconds for 1 unit, and the unit name
	array(1, "second"),
	array(60, "minute"),
	array(60 * 60, "hour"),
	array(60 * 60 * 24, "day"),
	array(60 * 60 * 24 * 7, "week"),
	array(60 * 60 * 24 * 7 * 4.35, "month"),
	array(60 * 60 * 24 * 7 * 4.35 * 12, "year")
);
$daysIn = array( // quantity of days for 1 unit, and the unit name
	array(1 * 24 * 60 * 60, "second"),
	array(1 * 24 * 60, "minute"),
	array(1 * 24, "hour"),
	array(1, "day"),
	array(1 / 7, "week"),
	array(1 / 7 / 4.35, "month"),
	array(1 / 7 / 4.35 / 12, "year")	
);
class Birthday extends DateTime { // these probably could have been added to the DateTime object model...
	public function sToMidnight() { // determines the qty of seconds after birth to following midnight.
		$temp = clone $this;
		$temp->add(new DateInterval('P1D'));
		$temp->setTime(00,00,00);
		return $temp->getTimestamp() - $this->getTimestamp();
	}
	public function sSinceMidnight($when) { // determines the qty of seconds from the previous midnight to specified time
		$temp = clone $when;
		$temp->setTime(00,00,00);
		$hours = $when->format('H');
		$minutes = $when->format('i');
		$seconds = $when->format('s');
		$totSecs = ((($hours * 60) + $minutes) * 60) + $seconds;
		return $totSecs;
	}
	public function age($when, $units, $secsIn) { // determines age and returns in $units (specified as an index of $secsIn). Included $secsIn as parameter because I don't know how to access that variable from inside this object.
		$temp = clone $this;
		if ($temp::diff($when)->format('%a') > 0) { // most cases, when $bday is more than 24 hours from $when
			$daysBetween = $temp::diff($when)->format('%a') - 1; // -1 since addings seconds manually for fractional days $bday and $when
			$output = (($daysBetween * 24 * 60 * 60) + $this->sToMidnight() + $this->sSinceMidnight($when)) / $secsIn[$units][0];
		} else { // when $bday is less than 24 hours from $when
			if($temp->format('d') < $when->format('d')) { // if $bday and $when are different days
				$daysBetween = 0;
				$output = (($daysBetween * 24 * 60 * 60) + $this->sToMidnight() + $this->sSinceMidnight($when)) / $secsIn[$units][0];
			} else { // if $bday and $when are same day
				$output = ($when->getTimestamp() - $temp->getTimestamp()) / $secsIn[$units][0];
			}
		}
		if($units < 5) {
			if(round($output) != 1) {
				return number_format($output, 0, ".", ",") . " " . $secsIn[$units][1] . "s";
			} else {
				return number_format($output, 0, ".", ",") . " " . $secsIn[$units][1];
			}
		} else {
			if(round($output, 2) != 1) {
				return number_format($output, 2, ".", ",") . " " . $secsIn[$units][1] . "s";
			} else {
				return number_format($output, 2, ".", ",") . " " . $secsIn[$units][1];
			}
		}
	}
	public function dateAfter($increment, $units, $daysIn, $secsIn) { // determines date after user provided $increment number in a variety of $units. Included $secsIn/$daysIn as parameter because I don't know how to access that variable from inside this object.
		$now = new DateTime ("now");
		$temp = clone $this;
		if($units == 6) { // to add years traditionally, rather than as a qty of days
			$temp->add(new DateInterval('P'.$increment.'Y'));
		} else if($units == 5) { // to add months traditionally, rather than as a qty of days
			$temp->add(new DateInterval('P'.$increment.'M'));
		} else {
			$incDays = floor($increment / $daysIn[$units][0]);
			$temp->add(new DateInterval('P'.$incDays.'D'));
			if($units < 4) {
				$extraSecs = ($increment % $daysIn[$units][0]) * $secsIn[$units][0];
				$temp->add(new DateInterval('PT'.$extraSecs.'S'));
			}	
		}
		if ($temp > $now) {
			$tense = "will be";
		} else {
			$tense = "were";
		}
		$output = array(
			$temp->format('F j, Y h:i:sa'),
			$tense
		);
		return $output;
	}
}
$funIncs = array( // significant increments - can be adjusted so that (IN)SIGNIFICANT section returns desired increments
	1000,
	5000,
	10000,
	15000,
	20000,
	25000,
	30000,
	35000
);
?>
</head>
<body>
	<img style="float: left;" src="calc.png" alt="Age Calculator" />
	<div id="body">
	<h1>AGE-O-MATIC Age Calculator</h1>
	<?php
		if($bday > $now) { // if user inputs $bday as later than current date/time
			echo "<h3>Oh dear me...</h3>";
			echo "<p>It appears that you've discovered time travel, and were born at some point after what my associates and I frequently refer to as &quot;now&quot;. If you don't remember traveling through time, perhaps you would you care to <a href='index.php'>enter another date</a>?</p>";
			echo "<style type='text/css'>#age { display: none; }</style>"; // hides results since they would not be accurate
			echo "<p>You selected " . $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') . ".</p>";
		}
	?>
	<h6>NOTE: I have not yet considered timezones in this revision, so for the moment, you'll need to make manual adjustments to the data submitted or retrieved to accomodate for your appropriate birth and current location timezones. My server is in the pacific timezone, where it is currently <?php echo $now->format('F j, Y h:i:sa') ?></h6>
	<div id="age">
	<h3>THE RESULTS</h3>
	<p>You were born <?php echo $bday->format('F j, Y') . " at " . $bday->format('h:i:sa') ?>.</p>
	<h6>Not you? You can <a href="index.php">start over here</a>.</h6>
	<p>As of <?php echo $now->format('F j, Y') . " at " . $now->format('h:i:sa') ?>, you are <strong><?php echo $bday->age($now, '3', $secsIn); ?></strong> old.</p>
	<p>Here is your age translated to some less useful units of time:</p>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'>" . $bday->age($now, $i, $secsIn) . "</td></tr>";
				}
			?>
		</tbody>
	</table>
	</div>
	<h3>(IN)SIGNIFICANT DATES</h3>
	<p>For no reason in particular, you can also see some dates and their associated significant quantities of units after your birth.</p>
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
	<form method="POST" action="">
		<label for="in">Show me this ridiculousness in</label>
		<select id="in" name="in">
			<?php
				for($i = 0; $i < count($secsIn); $i++) {
					echo "<option value='" . $i . "'>" . $secsIn[$i][1] . "s</option>";
				}
			?>
		</select>
		<input type="submit" name="inSelector" value="->">
	</form>
	<table>
		<tbody>
			<?php
				if(!empty($_POST['inSelector'])) {
					$in = ($_POST['in']);
					for ($i = 0; $i < count($funIncs); $i++) {
						$dateArray = $bday->dateAfter($funIncs[$i], $in, $daysIn, $secsIn);
						echo "<tr><td>You " . $dateArray[1] . " <strong>" . number_format($funIncs[$i]) . " " . $secsIn[$in][1] . "s</strong> old on " . $dateArray[0] . "</td></tr>";
					}
				}
			?>
		</tbody>
	</table>
	<h3>HAVE A FAVORITE NUMBER?</h3>
	<p>If you'd like to know when you'll be some certain number of somethings old, just type in the number here:</p>
	<form method="POST" action="">
		<label for="thisMany">Drumroll please:</label>
		<input type="text" id="thisMany" name="thisMany" required>
		<input type="submit" name="customDay" value="My Favorite!">
	</form>
	<?php 
	if(isset($_POST['customDay'])) {
		$thisMany = round($_POST['thisMany']);
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
	?>
	</div><!-- #body -->
</body>
</html>