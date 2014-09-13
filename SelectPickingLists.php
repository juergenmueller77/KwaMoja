<?php

include('includes/session.inc');
$Title = _('Search Pick Lists ');
include('includes/header.inc');

echo '<p class="page_title_text">
		<img src="' . $RootPath . '/css/' . $Theme . '/images/magnifier.png" title="' . _('Pick Lists') . '" alt=""  />' . ' ' . _('Pick Lists') . '</p>';

if (isset($_GET['SelectedStockItem'])) {
	$SelectedStockItem = $_GET['SelectedStockItem'];
} elseif (isset($_POST['SelectedStockItem'])) {
	$SelectedStockItem = $_POST['SelectedStockItem'];
}
if (isset($_GET['OrderNumber'])) {
	$OrderNumber = $_GET['OrderNumber'];
} elseif (isset($_POST['OrderNumber'])) {
	$OrderNumber = $_POST['OrderNumber'];
}
if (isset($_GET['PickList'])) {
	$PickList = $_GET['PickList'];
} elseif (isset($_POST['PickList'])) {
	$PickList = $_POST['PickList'];
}
if (!isset($_POST['Status'])) {
	$_POST['Status'] = 'New';
}

echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '" method="post">
	<input type="hidden" name="FormID" value="' . $_SESSION['FormID'] . '" />';
if (isset($_POST['ResetPart'])) {
	unset($SelectedStockItem);
}
if (isset($OrderNumber) and $OrderNumber != '') {
	if (!is_numeric($OrderNumber)) {
		prnMsg(_('The Order Number entered') . ' <u>' . _('MUST') . '</u> ' . _('be numeric'), 'error');
		unset($OrderNumber);
	} else {
		echo _('Order Number') . ' - ' . $OrderNumber;
	}
}
if (isset($PickList) and $PickList != '') {
	if (!is_numeric($PickList)) {
		prnMsg(_('The Pick List entered') . ' <u>' . _('MUST') . '</u> ' . _('be numeric'), 'error');
		unset($PickList);
	} else {
		echo _('Pick List') . ' - ' . $PickList;
	}
}
if (isset($_POST['SearchParts'])) {
	if ($_POST['Keywords'] and $_POST['StockCode']) {
		prnMsg(_('Stock description keywords have been used in preference to the Stock code extract entered'), 'info');
	}
	if ($_POST['Keywords']) {
		//insert wildcard characters in spaces
		$SearchString = '%' . str_replace(' ', '%', $_POST['Keywords']) . '%';
		$SQL = "SELECT stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				SUM(locstock.quantity) as qoh,
				stockmaster.units,
				(SELECT SUM(qtypicked)
					FROM pickreqdetails
					INNER JOIN pickreq ON pickreq.prid = pickreqdetails.prid
					INNER JOIN locationusers ON locationusers.loccode = pickreq.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview =1
					WHERE pickreq.closed=0
					AND stockmaster.stockid = pickreqdetails.stockid) AS qpicked
			FROM stockmaster INNER JOIN locstock
			ON stockmaster.stockid = locstock.stockid
			INNER JOIN locationusers ON locationusers.loccode = locstock.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview=1
			WHERE stockmaster.description " . LIKE . " '" . $SearchString . "'
			AND stockmaster.categoryid='" . $_POST['StockCat'] . "'
			GROUP BY stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				stockmaster.units
			ORDER BY stockmaster.stockid";
	} elseif ($_POST['StockCode']) {
		$SQL = "SELECT stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				SUM(locstock.quantity) AS qoh,
				(SELECT SUM(qtypicked)
					FROM pickreqdetails
					INNER JOIN pickreq ON pickreq.prid = pickreqdetails.prid
					INNER JOIN locationusers ON locationusers.loccode = pickreq.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview =1
					WHERE pickreq.closed=0
					AND stockmaster.stockid = pickreqdetails.stockid) AS qpicked,
				stockmaster.units
			FROM stockmaster INNER JOIN locstock
				ON stockmaster.stockid = locstock.stockid
			INNER JOIN locationusers ON locationusers.loccode = locstock.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview=1
			WHERE stockmaster.stockid " . LIKE . " '%" . $_POST['StockCode'] . "%'
			AND stockmaster.categoryid='" . $_POST['StockCat'] . "'
			GROUP BY stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				stockmaster.units
			ORDER BY stockmaster.stockid";
	} elseif (!$_POST['StockCode'] and !$_POST['Keywords']) {
		$SQL = "SELECT stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				SUM(locstock.quantity) AS qoh,
				stockmaster.units,
				(SELECT SUM(qtypicked)
					FROM pickreqdetails
					INNER JOIN pickreq ON pickreq.prid = pickreqdetails.prid
					INNER JOIN locationusers ON locationusers.loccode = pickreq.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview =1
					WHERE pickreq.closed=0
					AND stockmaster.stockid = pickreqdetails.stockid) AS qpicked
			FROM stockmaster INNER JOIN locstock ON stockmaster.stockid = locstock.stockid
			INNER JOIN locationusers ON locationusers.loccode = locstock.loccode
					AND locationusers.userid='" . $_SESSION['UserID'] . "'
					AND locationusers.canview =1
			WHERE stockmaster.categoryid='" . $_POST['StockCat'] . "'
			GROUP BY stockmaster.stockid,
				stockmaster.description,
				stockmaster.decimalplaces,
				stockmaster.units
			ORDER BY stockmaster.stockid";
	}

	$ErrMsg = _('No stock items were returned by the SQL because');
	$DbgMsg = _('The SQL used to retrieve the searched parts was');
	$StockItemsResult = DB_query($SQL, $ErrMsg, $DbgMsg);
}

if (true or !isset($OrderNumber) or $OrderNumber == "") { //revisit later, right now always show all inputs
	echo '<table class="selection"><tr><td>';
	if (isset($SelectedStockItem)) {
		echo _('For the part') . ':<b>' . $SelectedStockItem . '</b> ' . _('and') . ' <input type="hidden" name="SelectedStockItem" value="' . $SelectedStockItem . '" />';
	}
	echo _('Sales Order') . ': <input name="OrderNumber" autofocus="autofocus" maxlength="8" size="9" value="' . $OrderNumber . '"/> ' . _('Pick List') . ': <input name="PickList" maxlength="10" size="10" value="' . $PickList . '"/> ' . _('Into Stock Location') . ':<select name="StockLocation"> ';
	$SQL = "SELECT locations.loccode, locationname FROM locations
				INNER JOIN locationusers ON locationusers.loccode=locations.loccode AND locationusers.userid='" . $_SESSION['UserID'] . "' AND locationusers.canview=1";
	$ResultStkLocs = DB_query($SQL);
	while ($MyRow = DB_fetch_array($ResultStkLocs)) {
		if (isset($_POST['StockLocation'])) {
			if ($MyRow['loccode'] == $_POST['StockLocation']) {
				echo '<option selected="selected" value="' . $MyRow['loccode'] . '">' . $MyRow['locationname'] . '</option>';
			} else {
				echo '<option value="' . $MyRow['loccode'] . '">' . $MyRow['locationname'] . '</option>';
			}
		} elseif ($MyRow['loccode'] == $_SESSION['UserStockLocation']) {
			echo '<option selected="selected" value="' . $MyRow['loccode'] . '">' . $MyRow['locationname'] . '</option>';
		} else {
			echo '<option value="' . $MyRow['loccode'] . '">' . $MyRow['locationname'] . '</option>';
		}
	}
	echo '</select> ' . _('Pick List Status:') . ' <select name="Status">';
	//if (!isset($_POST['Status']) OR $_POST['Status']=='All'){
	//	echo '<option selected="selected" value="All">' . _('All') . '</option>';
	//} else {
	//	echo '<option value="All">' . _('All') . '</option>';
	//}
	if ($_POST['Status'] == 'New') {
		echo '<option selected="selected" value="New">' . _('New') . '</option>';
	} else {
		echo '<option value="New">' . _('New') . '</option>';
	}
	if ($_POST['Status'] == 'Picked') {
		echo '<option selected="selected" value="Picked">' . _('Picked') . '</option>';
	} else {
		echo '<option value="Picked">' . _('Picked') . '</option>';
	}
	if ($_POST['Status'] == 'Shipped') {
		echo '<option selected="selected" value="Shipped">' . _('Shipped') . '</option>';
	} else {
		echo '<option value="Shipped">' . _('Shipped') . '</option>';
	}
	if ($_POST['Status'] == 'Invoiced') {
		echo '<option selected="selected" value="Invoiced">' . _('Invoiced') . '</option>';
	} else {
		echo '<option value="Invoiced">' . _('Invoiced') . '</option>';
	}
	if ($_POST['Status'] == 'Cancelled') {
		echo '<option selected="selected" value="Cancelled">' . _('Cancelled') . '</option>';
	} else {
		echo '<option value="Cancelled">' . _('Cancelled') . '</option>';
	}

	echo '</select> <input type="submit" name="SearchOrders" value="' . _('Search Pick Lists') . '" /></td>
		</tr>
		</table>';
}
$SQL = "SELECT categoryid,
			categorydescription
		FROM stockcategory
		ORDER BY categorydescription";
$Result1 = DB_query($SQL);
echo '<br />
		<br />
		<table class="selection">
		<tr>
			<td>';
echo _('To search for Pick Lists for a specific part use the part selection facilities below') . '</td></tr>';
echo '<tr>
		<td>' . _('Select a stock category') . ':<select name="StockCat">';
while ($MyRow1 = DB_fetch_array($Result1)) {
	if (isset($_POST['StockCat']) and $MyRow1['categoryid'] == $_POST['StockCat']) {
		echo '<option selected="selected" value="' . $MyRow1['categoryid'] . '">' . $MyRow1['categorydescription'] . '</option>';
	} else {
		echo '<option value="' . $MyRow1['categoryid'] . '">' . $MyRow1['categorydescription'] . '</option>';
	}
}
echo '</select></td>
		<td>' . _('Enter text extracts in the') . ' <b>' . _('description') . '</b>:</td>
		<td><input type="text" name="Keywords" size="20" maxlength="25" /></td>
	</tr>
	<tr>
		<td></td>
		<td><b>' . _('OR') . ' </b>' . _('Enter extract of the') . '<b> ' . _('Stock Code') . '</b>:</td>
		<td><input type="text" name="StockCode" size="15" maxlength="18" /></td>
	</tr>
	<tr>
		<td colspan="3">
			<div class="centre">
				<input type="submit" name="SearchParts" value="' . _('Search Parts Now') . '" />
                <input type="submit" name="ResetPart" value="' . _('Show All') . '" />
			</div>
		</td>
	</tr>
	</table>
	<br />
	<br />';

if (isset($StockItemsResult)) {
	echo '<table class="selection">';
	echo '<tr>
			<th class="SortableColumn">' . _('Code') . '</th>
			<th class="SortableColumn">' . _('Description') . '</th>
			<th class="SortableColumn">' . _('On Hand') . '</th>
			<th class="SortableColumn">' . _('Picked') . '</th>
			<th class="SortableColumn">' . _('Units') . '</th>
		</tr>';
	$k = 0; //row colour counter
	while ($MyRow = DB_fetch_array($StockItemsResult)) {
		if ($k == 1) {
			echo '<tr class="EvenTableRows">';
			$k = 0;
		} else {
			echo '<tr class="OddTableRows">';
			$k = 1;
		}
		echo '<td><input type="submit" name="SelectedStockItem" value="' . $MyRow['stockid'] . '"</td>
			<td>' . $MyRow['description'] . '</td>
			<td class="number">' . locale_number_format($MyRow['qoh'], $MyRow['decimalplaces']) . '</td>
			<td class="number">' . locale_number_format($MyRow['qpicked'], $MyRow['decimalplaces']) . '</td>
			<td>' . $MyRow['units'] . '</td>
			</tr>';
		//end of page full new headings if

	}
	//end of while loop
	echo '</table>';
}
//end if stock search results to show
else {
	//figure out the SQL required from the inputs available

	if (!isset($_POST['Status']) or $_POST['Status'] == 'All') {
		$StatusCriteria = " AND (pickreq.status='New' OR pickreq.status='Picked' OR pickreq.status='Cancelled' OR pickreq.status='Shipped') ";
	} elseif ($_POST['Status'] == 'Picked') {
		$StatusCriteria = " AND (pickreq.status='Picked' OR pickreq.status='Printed')";
	} elseif ($_POST['Status'] == 'New') {
		$StatusCriteria = " AND pickreq.status='New' ";
	} elseif ($_POST['Status'] == 'Cancelled') {
		$StatusCriteria = " AND pickreq.status='Cancelled' ";
	} elseif ($_POST['Status'] == 'Shipped') {
		$StatusCriteria = " AND pickreq.status='Shipped' ";
	} elseif ($_POST['Status'] == 'Invoiced') {
		$StatusCriteria = " AND pickreq.status='Invoiced' ";
	}
	if (isset($OrderNumber) and $OrderNumber != '') {
		$SQL = "SELECT pickreq.orderno,
						pickreq.prid,
						pickreq.initdate,
						pickreq.requestdate,
						pickreq.initiator,
						pickreq.shipdate,
						pickreq.shippedby,
						pickreq.status,
						salesorders.printedpackingslip,
						debtorsmaster.name
					FROM pickreq
					INNER JOIN salesorders on salesorders.orderno=pickreq.orderno
					INNER JOIN debtorsmaster
					ON salesorders.debtorno = debtorsmaster.debtorno
					WHERE pickreq.orderno='" . filter_number_format($OrderNumber) . "'
					GROUP BY pickreq.orderno
					ORDER BY pickreq.requestdate, pickreq.prid";
	} elseif (isset($PickList) and $PickList != '') {
		$SQL = "SELECT pickreq.orderno,
						pickreq.prid,
						pickreq.initdate,
						pickreq.requestdate,
						pickreq.initiator,
						pickreq.shipdate,
						pickreq.shippedby,
						pickreq.status,
						salesorders.printedpackingslip,
						debtorsmaster.name
					FROM pickreq
					INNER JOIN salesorders on salesorders.orderno=pickreq.orderno
					INNER JOIN debtorsmaster
					ON salesorders.debtorno = debtorsmaster.debtorno
					WHERE pickreq.prid='" . filter_number_format($PickList) . "'
					GROUP BY pickreq.prid
					ORDER BY pickreq.requestdate, pickreq.prid";
	} else {
		if (empty($_POST['StockLocation'])) {
			$_POST['StockLocation'] = $_SESSION['UserStockLocation'];
		}
		if (isset($SelectedDebtor)) {
			//future functionality - search by customer
		} else { //no customer selected
			if (isset($SelectedStockItem)) {
				$SQL = "SELECT pickreq.orderno,
								pickreq.prid,
								pickreq.initdate,
								pickreq.requestdate,
								pickreq.initiator,
								pickreq.shipdate,
								pickreq.shippedby,
								pickreq.status,
								salesorders.printedpackingslip,
								debtorsmaster.name
							FROM pickreq
							INNER JOIN pickreqdetails
							ON pickreq.prid = pickreqdetails.prid
							INNER JOIN locationusers ON locationusers.loccode=pickreq.loccode AND locationusers.userid='" . $_SESSION['UserID'] . "' AND locationusers.canview=1
							INNER JOIN salesorders on salesorders.orderno=pickreq.orderno
							INNER JOIN debtorsmaster
							ON salesorders.debtorno = debtorsmaster.debtorno
							WHERE pickreqdetails.stockid='" . $SelectedStockItem . "'
							AND pickreq.loccode = '" . $_POST['StockLocation'] . "'
							" . $StatusCriteria . "
							GROUP BY pickreq.prid
							ORDER BY pickreq.requestdate, pickreq.prid";
			} else {
				$SQL = "SELECT pickreq.orderno,
								pickreq.prid,
								pickreq.initdate,
								pickreq.requestdate,
								pickreq.initiator,
								pickreq.shipdate,
								pickreq.shippedby,
								pickreq.status,
								salesorders.printedpackingslip,
								debtorsmaster.name
							FROM pickreq
							INNER JOIN pickreqdetails
							ON pickreq.prid = pickreqdetails.prid
							INNER JOIN locationusers ON locationusers.loccode=pickreq.loccode AND locationusers.userid='" . $_SESSION['UserID'] . "' AND locationusers.canview=1
							INNER JOIN salesorders on salesorders.orderno=pickreq.orderno
							INNER JOIN debtorsmaster
							ON salesorders.debtorno = debtorsmaster.debtorno
							WHERE pickreq.loccode = '" . $_POST['StockLocation'] . "'
							" . $StatusCriteria . "
							GROUP BY pickreq.prid
							ORDER BY pickreq.requestdate, pickreq.prid";
			} //no stock item selected
		} //no customer selected

	} //end not order number selected
	$ErrMsg = _('No pick lists were returned by the SQL because');
	$pickreqResult = DB_query($SQL, $ErrMsg);

	if (DB_num_rows($pickreqResult) > 0) {
		/*show a table of the pick lists returned by the SQL */
		echo '<table cellpadding="2" width="90%" class="selection">';
		echo '<tr>
				<th class="SortableColumn">' . _('Modify') . '</th>
				<th class="SortableColumn">' . _('Picking List') . '</th>
				<th class="SortableColumn">' . _('Packing List') . '</th>
				<th class="SortableColumn">' . _('Labels') . '</th>
				<th class="SortableColumn">' . _('Order') . '</th>
				<th class="SortableColumn">' . _('Customer') . '</th>
				<th class="SortableColumn">' . _('Request Date') . '</th>
				<th class="SortableColumn">' . _('Ship Date') . '</th>
				<th class="SortableColumn">' . _('Shipped By') . '</th>
				<th class="SortableColumn">' . _('Initiated On') . '</th>
				<th class="SortableColumn">' . _('Initiated By') . '</th>
			</tr>';
		$k = 0; //row colour counter
		while ($MyRow = DB_fetch_array($pickreqResult)) {
			if ($k == 1) {
				/*alternate bgcolour of row for highlighting */
				echo '<tr class="EvenTableRows">';
				$k = 0;
			} else {
				echo '<tr class="OddTableRows">';
				$k++;
			}
			$ModifyPickList = $RootPath . '/PickingLists.php?Prid=' . $MyRow['prid'];
			$PrintPickList = $RootPath . '/GeneratePickingList.php?TransNo=' . $MyRow['orderno'];
			if ($_SESSION['PackNoteFormat'] == 1) {
				/*Laser printed A4 default */
				$PrintDispatchNote = $RootPath . '/PrintCustOrder_generic.php?TransNo=' . $MyRow['orderno'];
			} else {
				/*pre-printed stationery default */
				$PrintDispatchNote = $RootPath . '/PrintCustOrder.php?TransNo=' . $MyRow['orderno'];
			}
			if ($MyRow['printedpackingslip'] == 0) {
				$PrintText = _('Print');
			} else {
				$PrintText = _('Reprint');
				$PrintDispatchNote .= '&Reprint=OK';
			}
			$PrintLabels = $RootPath . '/PDFShipLabel.php?Type=Sales&ORD=' . $MyRow['orderno'];
			$FormatedRequestDate = ConvertSQLDate($MyRow['requestdate']);
			$FormatedInitDate = ConvertSQLDate($MyRow['initdate']);
			$FormatedShipDate = ConvertSQLDate($MyRow['shipdate']);
			$Confirm_Invoice = '';
			if ($MyRow['status'] == "Shipped") {
				$Confirm_Invoice = '<td><a href="' . $RootPath . '/ConfirmDispatch_Invoice.php?OrderNumber=' . $MyRow['orderno'] . '">' . _('Invoice Order') . '</a></td>';
			}

			echo '<td><a href="' . $ModifyPickList . '">' . str_pad($MyRow['prid'], 10, '0', STR_PAD_LEFT) . '</a></td>
					<td><a href="' . $PrintPickList . '">Print <img src="' . $RootPath . '/css/' . $Theme . '/images/pdf.png" title="' . _('Click for PDF') . '" alt="" /></a></td>
					<td><a target="_blank" href="' . $PrintDispatchNote . '">' . $PrintText . ' <img src="' . $RootPath . '/css/' . $Theme . '/images/pdf.png" title="' . _('Click for PDF') . '" alt="" /></a></td>
					<td><a target="_blank" href="' . $PrintLabels . '">' . _('Labels') . '</a></td>
					<td>' . $MyRow['orderno'] . '</td>
					<td>' . $MyRow['name'] . '</td>
					<td>' . $FormatedRequestDate . '</td>
					<td>' . $FormatedShipDate . '</td>
					<td>' . $MyRow['shippedby'] . '</td>
					<td>' . $FormatedInitDate . '</td>
					<td>' . $MyRow['initiator'] . '</td>
					' . $Confirm_Invoice . '
					</tr>';
			//end of page full new headings if
		} //end of while loop
		echo '</table>';
	} // end if Pick Lists to show
}
echo '</form>';
if ($_POST['Status'] == 'New') {
	//office is gnerating picks.  Warehouse needs to see latest "To Do" list so refresh every 5 minutes
	echo '<meta http-equiv="refresh" content="300" url=' . $RootPath . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') . '">';
}
include('includes/footer.inc');
?>