<?php require('header.php'); ?>
<h3>Test Page</h3>
<!-- in Key
	0 = second
	1 = minute
	2 = hour
	3 = day
	4 = week
	5 = month
	6 = year
-->
<?php
	$name = "test1";
	$desc = "37 minutes old (same day)";
	$bday = new Birthday ("2016-12-31, , 22:00:00");
	$now = new DateTime ("2016-12-31, , 22:37:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>
<?php
	$name = "test2";
	$desc = "37 minutes old (diff day)";
	$bday = new Birthday ("2016-12-31, , 23:30:00");
	$now = new DateTime ("2017-01-01, , 00:07:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test3";
	$desc = "67 minutes old (same day)";
	$bday = new Birthday ("2016-12-31, , 22:00:00");
	$now = new DateTime ("2016-12-31, , 23:07:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test4";
	$desc = "67 minutes old (diff day)";
	$bday = new Birthday ("2016-12-31, , 23:00:00");
	$now = new DateTime ("2017-01-01, , 00:07:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test5";
	$desc = "23.5 hours old (same day)";
	$bday = new Birthday ("2016-12-31, , 00:15:00");
	$now = new DateTime ("2016-12-31, , 23:45:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test6";
	$desc = "23.5 hours old (diff day)";
	$bday = new Birthday ("2016-12-31, , 23:00:00");
	$now = new DateTime ("2017-01-01, , 22:30:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test7";
	$desc = "24.5 hours old";
	$bday = new Birthday ("2016-12-31, , 23:00:00");
	$now = new DateTime ("2017-01-01, , 23:30:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test8";
	$desc = "48.5 hours old";
	$bday = new Birthday ("2016-12-31, , 23:00:00");
	$now = new DateTime ("2017-01-02, , 23:30:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<?php
	$name = "test9";
	$desc = "1 week old";
	$bday = new Birthday ("2017-01-01, , 23:00:00");
	$now = new DateTime ("2017-01-08, , 23:30:00");
?>
<div id="<?php echo $name ?>">
<h4><strong><?php echo $name . "</strong> " . $desc ?></h4>
	<table>
		<tbody>
			<?php
				for ($i = 0; $i < count($secsIn); $i++) {
					echo "<tr><td align='right'><strong>" . $bday->age($now, $i, $secsIn) . "</strong> old!</td></tr>";
				}
			?>
		</tbody>
	</table>
	<p><?php echo $bday->format('M j, Y') . " at " . $bday->format('h:i:sa') ?> (start)<br /><?php echo $now->format('M j, Y') . " at " . $now->format('h:i:sa') ?> (end)</p>
</div>

<!--
~170 hours in days
~170 hours in hours
~170 hours in weeks -->