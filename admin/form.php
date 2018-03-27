<?PHP
/// Generates the headers for the html table
function echoHeader($spec) {
	echo('<div class="tr">');
	foreach($spec as $col) {
		echo('<div class="th">' . htmlspecialchars($col) . '</div>');
	}
	echo('<div class="th">Actions</div>');
	echo('</div>');
}

/// Generates a row for adding a new value
function echoCreate($spec, $extra_data=[]) {
	echo('<form class="tr" method="POST">');
	foreach($extra_data as $key => $value) {
		echo('<input name="' . htmlspecialchars($key) . '" type="hidden" value="' . htmlspecialchars($value) . '"></input>');
	}
	foreach($spec as $col) {
		echo('<div class="td"><input name="' . htmlspecialchars($col) . '"></input></div>');
	}
	echo('<div class="td"><input type="submit" name="action" value="create"></input></div>');
	echo('</form>');
}

function echoUpdate($spec, $primary, $row, $extra_data=[]) {
	echo('<form class="tr" method="POST">');
	foreach($primary as $col) {
		echo('<input name="old_' . htmlspecialchars($col) . '" type="hidden" value="' . htmlspecialchars($row[$col]) . '"></input>');
	}
	foreach($extra_data as $key => $value) {
		echo('<input name="' . htmlspecialchars($key) . '" type="hidden" value="' . htmlspecialchars($value) . '"></input>');
	}
	foreach($spec as $col) {
		echo('<div class="td"><input name="' . htmlspecialchars($col) . '" value="' . htmlspecialchars($row[$col]) . '"></input></div>');
	}
	echo('<div class="td"><input type="submit" name="action" value="update"></input>');
	echo('<input type="submit" name="action" value="delete"></input></div>');
	echo('</form>');
}

function echoStatic($spec, $row) {
	echo('<div class="tr">');
	foreach($spec as $col) {
		echo('<div class="td">' . htmlspecialchars($row[$col]) . '</div>');
	}
	echo('</div>');
}

?>
