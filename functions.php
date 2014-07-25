<?php
$bday = new Birthday ($_GET ['bday'] . " " . $_GET ['time']); //assigns user input to a DateTime object
$now = new DateTime ("now"); // creates a new DateTime object for the current time/date
$in = $_GET['in']; // selects units
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
				$extraSecs = ($increment % $daysIn[$units][0]) * $secsIn[$units][0];
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
	3.14,
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
	7000,
	7777,
	8000,
	8888,
	9000,
	10000,
	12345,
	15000,
	25000,
	50000,
	75000,
	77777,
	100000,
	123456,
	500000,
	777777,
	1000000,
	1234567,
	2000000,
	3000000,
	4000000,
	5000000,
	6000000,
	7000000,
	7777777,
	8000000,
	9000000,
	10000000,
	12345678,
	100000000,
	123456789,
	1000000000,
	1234567890,
	10000000000,
	100000000000,
	1000000000000,
	10000000000000,
	100000000000000,
	1000000000000000,
	10000000000000000,
);
?>