<?php

include('includes/session.inc');
$Title = _('Fixed Asset Locations');
$ViewTopic = 'FixedAssets';
$BookMark = 'AssetLocations';
include('includes/header.inc');
echo '<p class="page_title_text" >
		<img src="' . $RootPath . '/css/' . $_SESSION['Theme'] . '/images/maintenance.png" title="' . _('Search') . '" alt="" />' . ' ' . $Title . '
	</p>';

if (isset($_POST['submit']) and !isset($_POST['delete'])) {
	$InputError = 0;
	if (!isset($_POST['LocationID']) or mb_strlen($_POST['LocationID']) < 1) {
		prnMsg(_('You must enter at least one character in the location ID'), 'error');
		$InputError = 1;
	}
	if (!isset($_POST['LocationDescription']) or mb_strlen($_POST['LocationDescription']) < 1) {
		prnMsg(_('You must enter at least one character in the location description'), 'error');
		$InputError = 1;
	}
	if ($InputError == 0) {
		$SQL = "INSERT INTO fixedassetlocations
							VALUES ('" . $_POST['LocationID'] . "',
									'" . $_POST['LocationDescription'] . "',
									'" . $_POST['ParentLocationID'] . "')";
		$Result = DB_query($SQL);
	}
}
if (isset($_GET['SelectedLocation'])) {
	$SQL = "SELECT * FROM fixedassetlocations
		WHERE locationid='" . $_GET['SelectedLocation'] . "'";
	$Result = DB_query($SQL);
	$MyRow = DB_fetch_array($Result);
	$LocationID = $MyRow['locationid'];
	$LocationDescription = $MyRow['locationdescription'];
	$ParentLocationID = $MyRow['parentlocationid'];

} else {
	$LocationID = '';
	$LocationDescription = '';
}

//Attempting to update fields

if (isset($_POST['update']) and !isset($_POST['delete'])) {
	$InputError = 0;
	if (!isset($_POST['LocationDescription']) or mb_strlen($_POST['LocationDescription']) < 1) {
		prnMsg(_('You must enter at least one character in the location description'), 'error');
		$InputError = 1;
	}
	if ($InputError == 0) {
		$SQL = "UPDATE fixedassetlocations
					SET locationdescription='" . $_POST['LocationDescription'] . "',
						parentlocationid='" . $_POST['ParentLocationID'] . "'
					WHERE locationid ='" . $_POST['LocationID'] . "'";

		$Result = DB_query($SQL);
		echo '<meta http-equiv="Refresh" content="0; url="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '">';
	}
} else {
	// if you are not updating then you want to delete but lets be sure first.
	if (isset($_POST['delete'])) {
		$InputError = 0;

		$SQL = "SELECT COUNT(locationid) FROM fixedassetlocations WHERE parentlocationid='" . $_POST['LocationID'] . "'";
		$Result = DB_query($SQL);
		$MyRow = DB_fetch_row($Result);
		if ($MyRow[0] > 0) {
			prnMsg(_('This location has child locations so cannot be removed'), 'warning');
			$InputError = 1;
		}
		$SQL = "SELECT COUNT(assetid) FROM fixedassets WHERE assetlocation='" . $_POST['LocationID'] . "'";
		$Result = DB_query($SQL);
		$MyRow = DB_fetch_row($Result);
		if ($MyRow[0] > 0) {
			prnMsg(_('You have assets in this location so it cannot be removed'), 'warn');
			$InputError = 1;
		}
		if ($InputError == 0) {
			$SQL = "DELETE FROM fixedassetlocations WHERE locationid = '" . $_POST['LocationID'] . "'";
			$Result = DB_query($SQL);
			prnMsg(_('The location has been deleted successfully'), 'success');
		}
	}
}

$SQL = 'SELECT * FROM fixedassetlocations';
$Result = DB_query($SQL);

if (DB_num_rows($Result) > 0) {
	echo '<table class="selection">
		<tr>
			<th class="SortableColumn">' . _('Location ID') . '</th>
			<th class="SortableColumn">' . _('Location Description') . '</th>
			<th>' . _('Parent Location') . '</th>
		</tr>';
}
while ($MyRow = DB_fetch_array($Result)) {
	echo '<tr>
			<td>' . $MyRow['locationid'] . '</td>
			<td>' . $MyRow['locationdescription'] . '</td>';
	$ParentSql = "SELECT locationdescription FROM fixedassetlocations WHERE locationid='" . $MyRow['parentlocationid'] . "'";
	$ParentResult = DB_query($ParentSql);
	$ParentRow = DB_fetch_array($ParentResult);
	echo '<td>' . $ParentRow['locationdescription'] . '</td>
		<td><a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '?SelectedLocation=' . $MyRow['locationid'] . '">' . _('Edit') . '</a></td></tr>';
}

echo '</table>
	<br />';
echo '<form onSubmit="return VerifyForm(this);" id="LocationForm" method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '">
	  <div>
	<input type="hidden" name="FormID" value="' . $_SESSION['FormID'] . '" />
	<table class="selection">
	<tr>
		<th style="text-align:left">' . _('Location ID') . '</th>';
if (isset($_GET['SelectedLocation'])) {
	echo '<input type="hidden" name="LocationID" value="' . $LocationID . '" />';
	echo '<td>' . $LocationID . '</td>';
} else {
	echo '<td><input type="text" name="LocationID" required="required" minlength="1" maxlength="6" size="6" value="' . $LocationID . '" /></td>
		</tr>';
}

echo '<tr>
		<th style="text-align:left">' . _('Location Description') . '</th>
		<td><input type="text" name="LocationDescription" required="required" minlength="1" maxlength="20" size="20" value="' . $LocationDescription . '" /></td>
	</tr>
	<tr>
		<th style="text-align:left">' . _('Parent Location') . '</th>
		<td><select minlength="0" name="ParentLocationID">';

$SQL = "SELECT locationid, locationdescription FROM fixedassetlocations";
$Result = DB_query($SQL);

echo '<option value=""></option>';
while ($MyRow = DB_fetch_array($Result)) {
	if ($MyRow['locationid'] == $ParentLocationID) {
		echo '<option selected="selected" value="' . $MyRow['locationid'] . '">' . $MyRow['locationdescription'] . '</option>';
	} else {
		echo '<option value="' . $MyRow['locationid'] . '">' . $MyRow['locationdescription'] . '</option>';
	}
}
echo '</select></td>
	</tr>
	</table>
	<br />';

echo '<div class="centre">';
if (isset($_GET['SelectedLocation'])) {
	echo '<input type="submit" name="update" value="' . _('Update Information') . '" />';
	echo '<br />
		<br />
		<input type="submit" name="delete" value="' . _('Delete This Location') . '" />';
} else {
	echo '<input type="submit" name="submit" value="' . _('Enter Information') . '" />';
}
echo '</div>
	  </div>
	</form>';

include('includes/footer.inc');
?>