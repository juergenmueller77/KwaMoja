<?php

include('includes/session.inc');

$Title = _('Company Preferences');
/* KwaMoja manual links before header.inc */
$ViewTopic = 'CreatingNewSystem';
$BookMark = 'CompanyParameters';
include('includes/header.inc');

if (isset($Errors)) {
	unset($Errors);
}

//initialise no input errors assumed initially before we test
$InputError = 0;
$Errors = array();
$i = 1;

if (isset($_POST['submit'])) {


	/* actions to take once the user has clicked the submit button
	ie the page has called itself with some user input */

	//first off validate inputs sensible

	if (mb_strlen($_POST['CoyName']) > 40 or mb_strlen($_POST['CoyName']) == 0) {
		$InputError = 1;
		prnMsg(_('The company name must be entered and be fifty characters or less long'), 'error');
		$Errors[$i] = 'CoyName';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice1']) > 40) {
		$InputError = 1;
		prnMsg(_('The Line 1 of the address must be forty characters or less long'), 'error');
		$Errors[$i] = 'RegOffice1';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice2']) > 40) {
		$InputError = 1;
		prnMsg(_('The Line 2 of the address must be forty characters or less long'), 'error');
		$Errors[$i] = 'RegOffice2';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice3']) > 40) {
		$InputError = 1;
		prnMsg(_('The Line 3 of the address must be forty characters or less long'), 'error');
		$Errors[$i] = 'RegOffice3';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice4']) > 40) {
		$InputError = 1;
		prnMsg(_('The Line 4 of the address must be forty characters or less long'), 'error');
		$Errors[$i] = 'RegOffice4';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice5']) > 20) {
		$InputError = 1;
		prnMsg(_('The Line 5 of the address must be twenty characters or less long'), 'error');
		$Errors[$i] = 'RegOffice5';
		$i++;
	}
	if (mb_strlen($_POST['RegOffice6']) > 15) {
		$InputError = 1;
		prnMsg(_('The Line 6 of the address must be fifteen characters or less long'), 'error');
		$Errors[$i] = 'RegOffice6';
		$i++;
	}
	if (mb_strlen($_POST['Telephone']) > 25) {
		$InputError = 1;
		prnMsg(_('The telephone number must be 25 characters or less long'), 'error');
		$Errors[$i] = 'Telephone';
		$i++;
	}
	if (mb_strlen($_POST['Fax']) > 25) {
		$InputError = 1;
		prnMsg(_('The fax number must be 25 characters or less long'), 'error');
		$Errors[$i] = 'Fax';
		$i++;
	}
	if (mb_strlen($_POST['Email']) > 55) {
		$InputError = 1;
		prnMsg(_('The email address must be 55 characters or less long'), 'error');
		$Errors[$i] = 'Email';
		$i++;
	}
	if (mb_strlen($_POST['Email']) > 0 and !IsEmailAddress($_POST['Email'])) {
		$InputError = 1;
		prnMsg(_('The email address is not correctly formed'), 'error');
		$Errors[$i] = 'Email';
		$i++;
	}

	if ($InputError != 1) {

		if (isset($_SESSION['FirstStart'])) {
			$sql = "INSERT INTO companies (coycode,
											coyname,
											companynumber,
											gstno,
											regoffice1,
											regoffice2,
											regoffice3,
											regoffice4,
											regoffice5,
											regoffice6,
											telephone,
											fax,
											email,
											currencydefault,
											debtorsact,
											pytdiscountact,
											creditorsact,
											payrollact,
											grnact,
											exchangediffact,
											purchasesexchangediffact,
											retainedearnings,
											gllink_debtors,
											gllink_creditors,
											gllink_stock,
											freightact
										) VALUES (
											1,
											'" . $_POST['CoyName'] . "',
											'" . $_POST['CompanyNumber'] . "',
											'" . $_POST['GSTNo'] . "',
											'" . $_POST['RegOffice1'] . "',
											'" . $_POST['RegOffice2'] . "',
											'" . $_POST['RegOffice3'] . "',
											'" . $_POST['RegOffice4'] . "',
											'" . $_POST['RegOffice5'] . "',
											'" . $_POST['RegOffice6'] . "',
											'" . $_POST['Telephone'] . "',
											'" . $_POST['Fax'] . "',
											'" . $_POST['Email'] . "',
											'" . $_POST['CurrencyDefault'] . "',
											'" . $_POST['DebtorsAct'] . "',
											'" . $_POST['PytDiscountAct'] . "',
											'" . $_POST['CreditorsAct'] . "',
											'" . $_POST['PayrollAct'] . "',
											'" . $_POST['GRNAct'] . "',
											'" . $_POST['ExchangeDiffAct'] . "',
											'" . $_POST['PurchasesExchangeDiffAct'] . "',
											'" . $_POST['RetainedEarnings'] . "',
											'" . $_POST['GLLink_Debtors'] . "',
											'" . $_POST['GLLink_Creditors'] . "',
											'" . $_POST['GLLink_Stock'] . "',
											'" . $_POST['FreightAct'] . "'
										)";
		} else {

			$sql = "UPDATE companies SET coyname='" . $_POST['CoyName'] . "',
										companynumber = '" . $_POST['CompanyNumber'] . "',
										gstno='" . $_POST['GSTNo'] . "',
										regoffice1='" . $_POST['RegOffice1'] . "',
										regoffice2='" . $_POST['RegOffice2'] . "',
										regoffice3='" . $_POST['RegOffice3'] . "',
										regoffice4='" . $_POST['RegOffice4'] . "',
										regoffice5='" . $_POST['RegOffice5'] . "',
										regoffice6='" . $_POST['RegOffice6'] . "',
										telephone='" . $_POST['Telephone'] . "',
										fax='" . $_POST['Fax'] . "',
										email='" . $_POST['Email'] . "',
										currencydefault='" . $_POST['CurrencyDefault'] . "',
										debtorsact='" . $_POST['DebtorsAct'] . "',
										pytdiscountact='" . $_POST['PytDiscountAct'] . "',
										creditorsact='" . $_POST['CreditorsAct'] . "',
										payrollact='" . $_POST['PayrollAct'] . "',
										grnact='" . $_POST['GRNAct'] . "',
										exchangediffact='" . $_POST['ExchangeDiffAct'] . "',
										purchasesexchangediffact='" . $_POST['PurchasesExchangeDiffAct'] . "',
										retainedearnings='" . $_POST['RetainedEarnings'] . "',
										gllink_debtors='" . $_POST['GLLink_Debtors'] . "',
										gllink_creditors='" . $_POST['GLLink_Creditors'] . "',
										gllink_stock='" . $_POST['GLLink_Stock'] . "',
										freightact='" . $_POST['FreightAct'] . "'
									WHERE coycode=1";
		}

		$ErrMsg = _('The company preferences could not be updated because');
		$result = DB_query($sql, $db, $ErrMsg);
		prnMsg(_('Company preferences updated'), 'success');

		/* Alter the exchange rates in the currencies table */

		/* Get default currency rate */
		$sql = "SELECT rate from currencies WHERE currabrev='" . $_POST['CurrencyDefault'] . "'";
		$result = DB_query($sql, $db);
		$myrow = DB_fetch_row($result);
		$NewCurrencyRate = $myrow[0];

		/* Set new rates */
		$sql = "UPDATE currencies SET rate=rate/" . $NewCurrencyRate;
		$ErrMsg = _('Could not update the currency rates');
		$result = DB_query($sql, $db, $ErrMsg);

		/* End of update currencies */

		$ForceConfigReload = True; // Required to force a load even if stored in the session vars
		include('includes/GetConfig.php');
		$ForceConfigReload = False;

	} else {
		prnMsg(_('Validation failed') . ', ' . _('no updates or deletes took place'), 'warn');
	}

}
/* end of if submit */

echo '<p class="page_title_text noPrint" ><img src="' . $RootPath . '/css/' . $Theme . '/images/maintenance.png" title="' . _('Search') . '" alt="" />' . ' ' . $Title . '</p>';

echo '<form onSubmit="return VerifyForm(this);" method="post" class="noPrint" action="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '">';
echo '<input type="hidden" name="FormID" value="' . $_SESSION['FormID'] . '" />';
echo '<table class="selection">';

if ($InputError != 1) {
	$sql = "SELECT coyname,
					gstno,
					companynumber,
					regoffice1,
					regoffice2,
					regoffice3,
					regoffice4,
					regoffice5,
					regoffice6,
					telephone,
					fax,
					email,
					currencydefault,
					debtorsact,
					pytdiscountact,
					creditorsact,
					payrollact,
					grnact,
					exchangediffact,
					purchasesexchangediffact,
					retainedearnings,
					gllink_debtors,
					gllink_creditors,
					gllink_stock,
					freightact
				FROM companies
				WHERE coycode=1";

	$ErrMsg = _('The company preferences could not be retrieved because');
	$result = DB_query($sql, $db, $ErrMsg);

	$myrow = DB_fetch_array($result);

	$_POST['CoyName'] = $myrow['coyname'];
	$_POST['GSTNo'] = $myrow['gstno'];
	$_POST['CompanyNumber'] = $myrow['companynumber'];
	$_POST['RegOffice1'] = $myrow['regoffice1'];
	$_POST['RegOffice2'] = $myrow['regoffice2'];
	$_POST['RegOffice3'] = $myrow['regoffice3'];
	$_POST['RegOffice4'] = $myrow['regoffice4'];
	$_POST['RegOffice5'] = $myrow['regoffice5'];
	$_POST['RegOffice6'] = $myrow['regoffice6'];
	$_POST['Telephone'] = $myrow['telephone'];
	$_POST['Fax'] = $myrow['fax'];
	$_POST['Email'] = $myrow['email'];
	$_POST['CurrencyDefault'] = $myrow['currencydefault'];
	$_POST['DebtorsAct'] = $myrow['debtorsact'];
	$_POST['PytDiscountAct'] = $myrow['pytdiscountact'];
	$_POST['CreditorsAct'] = $myrow['creditorsact'];
	$_POST['PayrollAct'] = $myrow['payrollact'];
	$_POST['GRNAct'] = $myrow['grnact'];
	$_POST['ExchangeDiffAct'] = $myrow['exchangediffact'];
	$_POST['PurchasesExchangeDiffAct'] = $myrow['purchasesexchangediffact'];
	$_POST['RetainedEarnings'] = $myrow['retainedearnings'];
	$_POST['GLLink_Debtors'] = $myrow['gllink_debtors'];
	$_POST['GLLink_Creditors'] = $myrow['gllink_creditors'];
	$_POST['GLLink_Stock'] = $myrow['gllink_stock'];
	$_POST['FreightAct'] = $myrow['freightact'];
}

	if (DB_num_rows($result) == 0) {
		echo '<div class="page_help_text">' . _('As this is the first time that the system has been used, you must first fill out the company details.') .
				'<br />' . _('Once you have filled in all the details, click on the button at the bottom of the screen') . '</div>';
		include('companies/' . $_SESSION['DatabaseName'] . '/Companies.php');
		$_POST['CoyName'] = $CompanyName[$_SESSION['DatabaseName']];
	} elseif (DB_num_rows($result) == 1 and isset($_SESSION['FirstStart'])) {
		echo '<meta http-equiv="refresh" content="0; url=' . $RootPath . '/TaxProvinces.php">';
		exit;
	}

echo '<tr>
		<td>' . _('Name') . ' (' . _('to appear on reports') . '):</td>
		<td><input tabindex="1" type="text" name="CoyName" value="' . stripslashes($_POST['CoyName']) . '" size="52" required="required" minlength="1" maxlength="50" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Official Company Number') . ':</td>
		<td><input tabindex="2" type="text" name="CompanyNumber" value="' . $_POST['CompanyNumber'] . '" size="22" minlength="0" maxlength="20" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Tax Authority Reference') . ':</td>
		<td><input tabindex="3" type="text" name="GSTNo" value="' . $_POST['GSTNo'] . '" size="22" minlength="0" maxlength="20" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Address Line 1') . ':</td>
		<td><input tabindex="4" type="text" name="RegOffice1" size="42" minlength="0" maxlength="40" value="' . stripslashes($_POST['RegOffice1']) . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Address Line 2') . ':</td>
		<td><input tabindex="5" type="text" name="RegOffice2" size="42" minlength="0" maxlength="40" value="' . stripslashes($_POST['RegOffice2']) . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Address Line 3') . ':</td>
		<td><input tabindex="6" type="text" name="RegOffice3" size="42" minlength="0" maxlength="40" value="' . stripslashes($_POST['RegOffice3']) . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Address Line 4') . ':</td>
		<td><input tabindex="7" type="text" name="RegOffice4" size="42" minlength="0" maxlength="40" value="' . stripslashes($_POST['RegOffice4']) . '" /></td>
</tr>';

echo '<tr>
		<td>' . _('Address Line 5') . ':</td>
		<td><input tabindex="8" type="text" name="RegOffice5" size="22" minlength="0" maxlength="20" value="' . stripslashes($_POST['RegOffice5']) . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Address Line 6') . ':</td>
		<td><input tabindex="9" type="text" name="RegOffice6" size="17" minlength="0" maxlength="15" value="' . stripslashes($_POST['RegOffice6']) . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Telephone Number') . ':</td>
		<td><input tabindex="10" type="tel" name="Telephone" size="26" minlength="0" maxlength="25" value="' . $_POST['Telephone'] . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Facsimile Number') . ':</td>
		<td><input tabindex="11" type="tel" name="Fax" size="26" minlength="0" maxlength="25" value="' . $_POST['Fax'] . '" /></td>
	</tr>';

echo '<tr>
		<td>' . _('Email Address') . ':</td>
		<td><input tabindex="12" type="email" name="Email" size="50" minlength="0" maxlength="55" value="' . $_POST['Email'] . '" /></td>
	</tr>';


$result = DB_query("SELECT currabrev, currency FROM currencies", $db);

echo '<tr>
		<td>' . _('Home Currency') . ':</td>
		<td><select minlength="0" tabindex="13" name="CurrencyDefault">';

while ($myrow = DB_fetch_array($result)) {
	if ($_POST['CurrencyDefault'] == $myrow['currabrev']) {
		echo '<option selected="selected" value="' . $myrow['currabrev'] . '">' . $CurrenciesArray[$myrow['currabrev']]['Currency'] . '</option>';
	} else {
		echo '<option value="' . $myrow['currabrev'] . '">' . $CurrenciesArray[$myrow['currabrev']]['Currency'] . '</option>';
	}
} //end while loop

DB_free_result($result);

echo '</select></td>
	</tr>';

$result = DB_query("SELECT accountcode,
						accountname
					FROM chartmaster INNER JOIN accountgroups
					ON chartmaster.group_=accountgroups.groupname
					WHERE accountgroups.pandl=0
					ORDER BY chartmaster.accountcode", $db);

echo '<tr>
		<td>' . _('Debtors Control GL Account') . ':</td>
		<td><select minlength="0" tabindex="14" name="DebtorsAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['DebtorsAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Creditors Control GL Account') . ':</td>
		<td><select minlength="0" tabindex="15" name="CreditorsAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['CreditorsAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Payroll Net Pay Clearing GL Account') . ':</td>
		<td><select minlength="0" tabindex="16" name="PayrollAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['PayrollAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Goods Received Clearing GL Account') . ':</td>
		<td><select minlength="0" tabindex="17" name="GRNAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['GRNAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);
echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Retained Earning Clearing GL Account') . ':</td>
		<td><select minlength="0" tabindex="18" name="RetainedEarnings">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['RetainedEarnings'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_free_result($result);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Freight Re-charged GL Account') . ':</td>
		<td><select minlength="0" tabindex="19" name="FreightAct">';

$result = DB_query("SELECT accountcode,
						accountname
					FROM chartmaster INNER JOIN accountgroups
					ON chartmaster.group_=accountgroups.groupname
					WHERE accountgroups.pandl=1
					ORDER BY chartmaster.accountcode", $db);

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['FreightAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Sales Exchange Variances GL Account') . ':</td>
		<td><select minlength="0" tabindex="20" name="ExchangeDiffAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['ExchangeDiffAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Purchases Exchange Variances GL Account') . ':</td>
		<td><select minlength="0" tabindex="21" name="PurchasesExchangeDiffAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['PurchasesExchangeDiffAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option  value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Payment Discount GL Account') . ':</td>
		<td><select minlength="0" tabindex="22" name="PytDiscountAct">';

while ($myrow = DB_fetch_row($result)) {
	if ($_POST['PytDiscountAct'] == $myrow[0]) {
		echo '<option selected="selected" value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	} else {
		echo '<option value="' . $myrow[0] . '">' . htmlspecialchars($myrow[1], ENT_QUOTES, 'UTF-8') . ' (' . $myrow[0] . ')</option>';
	}
} //end while loop

DB_data_seek($result, 0);

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Create GL entries for accounts receivable transactions') . ':</td>
		<td><select minlength="0" tabindex="23" name="GLLink_Debtors">';

if ($_POST['GLLink_Debtors'] == 0) {
	echo '<option selected="selected" value="0">' . _('No') . '</option>';
	echo '<option value="1">' . _('Yes') . '</option>';
} else {
	echo '<option selected="selected" value="1">' . _('Yes') . '</option>';
	echo '<option value="0">' . _('No') . '</option>';
}

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Create GL entries for accounts payable transactions') . ':</td>
		<td><select minlength="0" tabindex="24" name="GLLink_Creditors">';

if ($_POST['GLLink_Creditors'] == 0) {
	echo '<option selected="selected" value="0">' . _('No') . '</option>';
	echo '<option value="1">' . _('Yes') . '</option>';
} else {
	echo '<option selected="selected" value="1">' . _('Yes') . '</option>';
	echo '<option value="0">' . _('No') . '</option>';
}

echo '</select></td>
	</tr>';

echo '<tr>
		<td>' . _('Create GL entries for stock transactions') . ':</td>
		<td><select minlength="0" tabindex="25" name="GLLink_Stock">';

if ($_POST['GLLink_Stock'] == '0') {
	echo '<option selected="selected" value="0">' . _('No') . '</option>';
	echo '<option value="1">' . _('Yes') . '</option>';
} else {
	echo '<option selected="selected" value="1">' . _('Yes') . '</option>';
	echo '<option value="0">' . _('No') . '</option>';
}

echo '</select></td>
	</tr>';


echo '</table>
	<br />
	<div class="centre">
		<input tabindex="26" type="submit" name="submit" value="' . _('Update') . '" />
	</div>';
echo '</form>';

include('includes/footer.inc');
?>