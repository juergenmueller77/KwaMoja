<?php
$PageSecurity = 0;

include('includes/session.inc');

if (file_exists('install/InitialScripts.txt') and (filesize('install/InitialScripts.txt') > 0) and isset($_SESSION['DatabaseName'])) {
	echo '<meta http-equiv="refresh" content="0; url=' . $RootPath . '/InitialScripts.php">';
	exit;
}

$Title = _('Main Menu');
include('includes/header.inc');

if (!isset($_SESSION['MenuItems'])) {
	include('includes/MainMenuLinksArray.php');
}

if (isset($SupplierLogin) and $SupplierLogin == 1) {
	echo '<br /><table class="table_index">
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/SupplierTenders.php?TenderType=1">&bull; ' . _('View or Amend outstanding offers') . '</a></p>
			</td>
			</tr>
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/SupplierTenders.php?TenderType=2">&bull; ' . _('Create a new offer') . '</a></p>
			</td>
			</tr>
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/SupplierTenders.php?TenderType=3">&bull; ' . _('View any open tenders without an offer') . '</a></p>
			</td>
			</tr>
		</table><br />';
	include('includes/footer.inc');
	exit;
} elseif (isset($SupplierLogin) and $SupplierLogin == 0) {
	echo '<br /><table class="table_index">
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/CustomerInquiry.php?CustomerID=' . urlencode($_SESSION['CustomerID']) . '">&bull; ' . _('Account Status') . '</a></p>
			</td>
			</tr>
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/SelectOrderItems.php?NewOrder=Yes">&bull; ' . _('Place An Order') . '</a></p>
			</td>
			</tr>
			<tr>
			<td class="menu_group_item">
				<p><a href="' . $RootPath . '/SelectCompletedOrder.php?SelectedCustomer=' . urlencode($_SESSION['CustomerID']) . '">&bull; ' . _('Order Status') . '</a></p>
			</td>
			</tr>
		</table><br />';

	include('includes/footer.inc');
	exit;
}

if (isset($_GET['Application'])) {
	/*This is sent by this page (to itself) when the user clicks on a tab */
	$_SESSION['Module'] = $_GET['Application'];
}

//=== MainMenuDiv =======================================================================
echo '<div id="MainMenuDiv"><ul>'; //===HJ===
$i = 0;
while ($i < count($_SESSION['ModuleLink'])) {
	// This determines if the user has display access to the module see config.php and header.inc
	// for the authorisation and security code
	if ($_SESSION['ModulesEnabled'][$i] == 1) {
		// If this is the first time the application is loaded then it is possible that
		// SESSION['Module'] is not set if so set it to the first module that is enabled for the user
		if (!isset($_SESSION['Module']) or $_SESSION['Module'] == '') {
			$_SESSION['Module'] = $_SESSION['ModuleLink'][$i];
		}
		if ($_SESSION['ModuleLink'][$i] == $_SESSION['Module']) {
			echo '<li class="main_menu_selected">';
		} else {
			echo '<li class="main_menu_unselected">';

		}
		echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '?Application=' . urlencode($_SESSION['ModuleLink'][$i]) . '">' . $_SESSION['ModuleList'][$i] . '</a></li>';
	}
	$i++;
}
echo '</ul></div>'; // MainMenuDiv ===HJ===


//=== SubMenuDiv (wrapper) ==============================================================================
echo '<div id="SubMenuDiv">'; //===HJ===


echo '<div id="TransactionsDiv"><ul>'; //=== TransactionsDiv ===

echo '<li class="menu_group_headers">'; //=== SubMenuHeader ===
if ($_SESSION['Module'] == 'system') {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/company.png" title="' . _('General Setup Options') . '" alt="' . _('General Setup Options') . '" /><b>' . _('General Setup Options') . '</b>';
} else {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/transactions.png" title="' . _('Transactions') . '" alt="' . _('Transactions') . '" /><b>' . _('Transactions') . '</b>';
}
echo $Header;
echo '</li>'; // SubMenuHeader

//=== SubMenu Items ===
$i = 0;
foreach ($_SESSION['MenuItems'][$_SESSION['Module']]['Transactions']['Caption'] as $Caption) {
	/* Transactions Menu Item */
	$ScriptNameArray = explode('?', substr($_SESSION['MenuItems'][$_SESSION['Module']]['Transactions']['URL'][$i], 1));
	if (isset($_SESSION['PageSecurityArray'][$ScriptNameArray[0]])) {
		$PageSecurity = $_SESSION['PageSecurityArray'][$ScriptNameArray[0]];
	}
	if ((in_array($PageSecurity, $_SESSION['AllowedPageSecurityTokens']) and $PageSecurity != '')) {
		echo '<li class="menu_group_item">
				<p><a href="' . $RootPath . $_SESSION['MenuItems'][$_SESSION['Module']]['Transactions']['URL'][$i] . '">&bull; ' . $Caption . '</a></p>
			  </li>';
	}
	$i++;
}
echo '</ul></div>'; //=== TransactionsDiv ===


echo '<div id="InquiriesDiv"><ul>'; //=== InquiriesDiv ===

echo '<li class="menu_group_headers">';
if ($_SESSION['Module'] == 'system') {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/ar.png" title="' . _('Receivables/Payables Setup') . '" alt="' . _('Receivables/Payables Setup') . '" /><b>' . _('Receivables/Payables Setup') . '</b>';
} else {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/reports.png" title="' . _('Inquiries and Reports') . '" alt="' . _('Inquiries and Reports') . '" /><b>' . _('Inquiries and Reports') . '</b>';
}
echo $Header;
echo '</li>';


$i = 0;
if (isset($_SESSION['MenuItems'][$_SESSION['Module']]['Reports'])) {
	foreach ($_SESSION['MenuItems'][$_SESSION['Module']]['Reports']['Caption'] as $Caption) {
		/* Transactions Menu Item */
		$ScriptNameArray = explode('?', substr($_SESSION['MenuItems'][$_SESSION['Module']]['Reports']['URL'][$i], 1));
		$PageSecurity = $_SESSION['PageSecurityArray'][$ScriptNameArray[0]];
		if ((in_array($PageSecurity, $_SESSION['AllowedPageSecurityTokens']) or !isset($PageSecurity))) {
			echo '<li class="menu_group_item">
					<p><a href="' . $RootPath . $_SESSION['MenuItems'][$_SESSION['Module']]['Reports']['URL'][$i] . '">&bull; ' . $Caption . '</a></p>
				</li>';
		}
		$i++;
	}
}

echo GetRptLinks($_SESSION['Module']); //=== GetRptLinks() must be modified!!! ===
echo '</ul></div>'; //=== InquiriesDiv ===

echo '<div id="MaintenanceDiv"><ul>'; //=== MaintenanceDive ===

echo '<li class="menu_group_headers">';
if ($_SESSION['Module'] == 'system') {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/inventory.png" title="' . _('Inventory Setup') . '" alt="' . _('Inventory Setup') . '" /><b>' . _('Inventory Setup') . '</b>';
} else {
	$Header = '<img src="' . $RootPath . '/css/' . $Theme . '/images/maintenance.png" title="' . _('Maintenance') . '" alt="' . _('Maintenance') . '" /><b>' . _('Maintenance') . '</b>';
}
echo $Header;
echo '</li>';

$i = 0;
if (isset($_SESSION['MenuItems'][$_SESSION['Module']]['Maintenance'])) {
	foreach ($_SESSION['MenuItems'][$_SESSION['Module']]['Maintenance']['Caption'] as $Caption) {
		/* Transactions Menu Item */
		$ScriptNameArray = explode('?', substr($_SESSION['MenuItems'][$_SESSION['Module']]['Maintenance']['URL'][$i], 1));
		if (isset($_SESSION['PageSecurityArray'][$ScriptNameArray[0]])) {
			$PageSecurity = $_SESSION['PageSecurityArray'][$ScriptNameArray[0]];
			if ((in_array($PageSecurity, $_SESSION['AllowedPageSecurityTokens']) or !isset($PageSecurity))) {
				echo '<li class="menu_group_item">
						<p><a href="' . $RootPath . $_SESSION['MenuItems'][$_SESSION['Module']]['Maintenance']['URL'][$i] . '">&bull; ' . $Caption . '</a></p>
					</li>';
			}
		}
		$i++;
	}
}
echo '</ul></div>'; // MaintenanceDive ===HJ===
echo '</div>'; // SubMenuDiv ===HJ===

include('includes/footer.inc');

function GetRptLinks($GroupID) {
	/*
	This function retrieves the reports given a certain group id as defined in /reports/admin/defaults.php
	in the acssociative array $ReportGroups[]. It will fetch the reports belonging solely to the group
	specified to create a list of links for insertion into a table to choose a report. Two table sections will
	be generated, one for standard reports and the other for custom reports.
	*/
	global $RootPath;
	$FormGroups = array (
		'gl:chk' => _('Bank Checks'),	// Bank checks grouped with the gl report group
		'ar:col' => _('Collection Letters'),
		'ar:cust' => _('Customer Statements'),
		'gl:deps' => _('Bank Deposit Slips'),
		'ar:inv' => _('Invoices and Packing Slips'),
		'ar:lblc' => _('Labels - Customer'),
		'prch:lblv' => _('Labels - Vendor'),
		'prch:po' => _('Purchase Orders'),
		'ord:quot' => _('Customer Quotes'),
		'ar:rcpt' => _('Sales Receipts'),
		'ord:so' => _('Sales Orders'),
		'misc:misc' => _('Miscellaneous'));  // do not delete misc category
	if (isset($_SESSION['ReportList'][$GroupID])) {
		$GroupID = $_SESSION['ReportList'][$GroupID];
	}
	$Title = array(
		_('Custom Reports'),
		_('Standard Reports and Forms')
	);

	$sql = "SELECT id,
					reporttype,
					defaultreport,
					groupname,
					reportname
				FROM reports
				ORDER BY groupname,
						reportname";
	$Result = DB_query($sql, '', '', false, true);
	$_SESSION['ReportList'] = array();
	while ($Temp = DB_fetch_array($Result))
		$_SESSION['ReportList'][] = $Temp;

	$RptLinks = '';
	for ($Def = 1; $Def >= 0; $Def--) {
		$RptLinks .= '<li class="menu_group_headers">';
		$RptLinks .= '<b>' . $Title[$Def] . '</b>';
		$RptLinks .= '</li>';
		$NoEntries = true;
		if ($_SESSION['ReportList']) { // then there are reports to show, show by grouping
			foreach ($_SESSION['ReportList'] as $Report) {
				if ($Report['groupname'] == $GroupID and $Report['defaultreport'] == $Def) {
					$RptLinks .= '<li class="menu_group_item">';
					$RptLinks .= '<p><a href="' . $RootPath . '/reportwriter/ReportMaker.php?action=go&amp;reportid=' . urlencode($Report['id']) . '">&bull; ' . _($Report['reportname']) . '</a></p>';
					$RptLinks .= '</li>';
					$NoEntries = false;
				}
			}
			// now fetch the form groups that are a part of this group (List after reports)
			$NoForms = true;
			foreach ($_SESSION['ReportList'] as $Report) {
				$Group = explode(':', $Report['groupname']); // break into main group and form group array
				if ($NoForms and $Group[0] == $GroupID and $Report['reporttype'] == 'frm' and $Report['defaultreport'] == $Def) {
					$RptLinks .= '<li class="menu_group_item">';
					$RptLinks .= '<img src="' . $RootPath . '/css/' . $_SESSION['Theme'] . '/images/folders.gif" width="16" height="13" alt="" />&nbsp;';
					$RptLinks .= '<a href="' . $RootPath . '/reportwriter/FormMaker.php?id=' . urlencode($Report['groupname']) . '">&bull; ';
					$RptLinks .= $FormGroups[$Report['groupname']] . '</a>';
					$RptLinks .= '</li>';
					$NoForms = false;
					$NoEntries = false;
				}
			}
		}
		if ($NoEntries)
			$RptLinks .= '<li class="menu_group_item">' . _('There are no reports to show!') . '</li>';
	}
	return $RptLinks;
}

?>