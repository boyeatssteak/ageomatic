<?php
if($_GET) {
	$bday = new Birthday ($_GET ['bday'] . " " . $_GET ['time']); //assigns user input to a DateTime object
	$now = new DateTime ("now"); // creates a new DateTime object for the current time/date
	$in = $_GET['in']; // selects units
}
$secsIn = array( // quantity of seconds for 1 unit, and the unit name
	array(1, "second"),
	array(60, "minute"),
	array(60 * 60, "hour"),
	array(60 * 60 * 24, "day"),
	array(60 * 60 * 24 * 7, "week"),
	array(60 * 60 * 24 * 365.25 / 12, "month"),
	array(60 * 60 * 24 * 365.25, "year")
);
$daysIn = array( // quantity of days for 1 unit, and the unit name
	array(1 * 24 * 60 * 60, "second"),
	array(1 * 24 * 60, "minute"),
	array(1 * 24, "hour"),
	array(1, "day"),
	array(1 / 7, "week"),
	array(365.25 / 12, "month"),
	array(365.25, "year")
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
		if($units < 4) {
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
	public function ageNumOnly($when, $units, $secsIn) { // determines age and returns in $units (specified as an index of $secsIn). Included $secsIn as parameter because I don't know how to access that variable from inside this object.
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
		if($units < 4) {
			return round($output);
		} else {
			return round($output, 2);
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
				$extraSecs = (bcmod($increment, $daysIn[$units][0])) * $secsIn[$units][0];
				$temp->add(new DateInterval('PT'.$extraSecs.'S'));
			}	
		}
		if ($temp > $now) {
			$tense = "will be";
		} else {
			$tense = "was";
		}
		$output = array(
			$temp->format('F j, Y h:i:sa'),
			$tense
		);
		return $output;
	}
}
$funIncs = array( // significant increments - can be adjusted so that (IN)SIGNIFICANT section returns desired increments
	0,
	1,
	5,
	10,
	100,
	111,
	123,
	200,
	222,
	300,
	333,
	400,
	444,
	500,
	555,
	600,
	666,
	700,
	777,
	800,
	888,
	900,
	1000,
	1111,
	1234,
	2000,
	2222,
	3000,
	3333,
	4000,
	4444,
	5000,
	5555,
	6000,
	6666,
	7000,
	7777,
	8000,
	8888,
	9000,
	10000,
	11111,
	12345,
	20000,
	22222,
	30000,
	33333,
	40000,
	44444,
	50000,
	55555,
	60000,
	66666,
	70000,
	77777,
	80000,
	88888,
	90000,
	100000,
	111111,
	123456,
	200000,
	222222,
	300000,
	333333,
	400000,
	444444,
	500000,
	555555,
	600000,
	666666,
	700000,
	777777,
	800000,
	888888,
	900000,
	1000000,
	1111111,
	1234567,
	2000000,
	2222222,
	3000000,
	3333333,
	4000000,
	4444444,
	5000000,
	5555555,
	6000000,
	6666666,
	7000000,
	7777777,
	8000000,
	8888888,
	9000000,
	10000000,
	11111111,
	12345678,
	20000000,
	22222222,
	30000000,
	33333333,
	40000000,
	44444444,
	50000000,
	55555555,
	60000000,
	66666666,
	70000000,
	77777777,
	80000000,
	88888888,
	90000000,
	100000000,
	111111111,
	123123123,
	123456789,
	200000000,
	222222222,
	300000000,
	333333333,
	400000000,
	444444444,
	500000000,
	555555555,
	600000000,
	666666666,
	700000000,
	777777777,
	800000000,
	888888888,
	900000000,
	1000000000,
	1111111111,
	1234512345,
	1234567890,
	2000000000,
	2147483647, // max PHP integer
	2222222222,
	3000000000,
	3333333333,
	4000000000,
	4444444444,
	5000000000,
	5555555555,
	6000000000,
	6666666666,
	7000000000,
	7777777777,
	8000000000,
	8888888888,
	9000000000,
	10000000000,
	11111111111,
	12345123456,
	12345612345,
	20000000000,
	22222222222,
	30000000000,
	33333333333,
	40000000000,
	44444444444,
	50000000000,
	55555555555,
	60000000000,
	66666666666,
	70000000000,
	77777777777,
	80000000000,
	88888888888,
	90000000000,
	100000000000,
	1000000000000,
);
?>