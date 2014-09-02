<?php

/* Check that the stock code*/
function VerifyStockCode($StockCode, $i, $Errors) {
	$Searchsql = "SELECT count(stockid)
					  FROM stockmaster
					  WHERE stockid='" . $StockCode . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] > 0) {
		$Errors[$i] = StockCodeAlreadyExists;
	}
	return $Errors;
}

/* Check that the stock code exists*/
function VerifyStockCodeExists($StockCode, $i, $Errors) {
	$Searchsql = "SELECT count(stockid)
					  FROM stockmaster
					  WHERE stockid='" . $StockCode . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] == 0) {
		$Errors[$i] = StockCodeDoesntExist;
	}
	return $Errors;
}

/* Verify the category exists */
function VerifyStockCategoryExists($StockCategory, $i, $Errors) {
	$Searchsql = "SELECT count(categoryid)
					  FROM stockcategory
					  WHERE categoryid='" . $StockCategory . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] == 0) {
		$Errors[$i] = StockCategoryDoesntExist;
	}
	return $Errors;
}

/* Check that the description is 50 characters or less long */
function VerifyStockDescription($StockDescription, $i, $Errors) {
	if (mb_strlen($StockDescription) > 50) {
		$Errors[$i] = IncorrectStockDescriptionLength;
	}
	return $Errors;
}

/* Check that the long description is 256 characters or less long */
function VerifyStockLongDescription($StockLongDescription, $i, $Errors) {
	if (mb_strlen($StockLongDescription) > 256) {
		$Errors[$i] = IncorrectLongStockDescriptionLength;
	}
	return $Errors;
}

/* Check that the units description is 20 characters or less long */
function VerifyUnits($units, $i, $Errors) {
	if (mb_strlen($units) > 20) {
		$Errors[$i] = IncorrectUnitsLength;
	}
	return $Errors;
}

/* Check the mbflag has a valid value */
function VerifyMBFlag($mbflag, $i, $Errors) {
	if ($mbflag != 'M' and $mbflag != 'K' and $mbflag != 'A' and $mbflag != 'B' and $mbflag != 'D' and $mbflag != 'G') {
		$Errors[$i] = IncorrectMBFlag;
	}
	return $Errors;
}

/* Check that the last current cost date is a valid date. The date
 * must be in the same format as the date format specified in the
 * target KwaMoja company */
function VerifyLastCurCostDate($CurCostDate, $i, $Errors) {
	$SQL = "SELECT confvalue FROM config WHERE confname='DefaultDateFormat'";
	$result = api_DB_query($SQL);
	$MyRow = DB_fetch_array($result);
	$DateFormat = $MyRow[0];
	if (mb_strstr('/', $PeriodEnd)) {
		$Date_Array = explode('/', $PeriodEnd);
	} elseif (mb_strstr('.', $PeriodEnd)) {
		$Date_Array = explode('.', $PeriodEnd);
	}
	if ($DateFormat == 'd/m/Y') {
		$Day = $DateArray[0];
		$Month = $DateArray[1];
		$Year = $DateArray[2];
	} elseif ($DateFormat == 'm/d/Y') {
		$Day = $DateArray[1];
		$Month = $DateArray[0];
		$Year = $DateArray[2];
	} elseif ($DateFormat == 'Y/m/d') {
		$Day = $DateArray[2];
		$Month = $DateArray[1];
		$Year = $DateArray[0];
	} elseif ($DateFormat == 'd.m.Y') {
		$Day = $DateArray[0];
		$Month = $DateArray[1];
		$Year = $DateArray[2];
	}
	if (!checkdate(intval($Month), intval($Day), intval($Year))) {
		$Errors[$i] = InvalidCurCostDate;
	}
	return $Errors;
}

/* Verify that the actual cost figure is numeric */
function VerifyActualCost($ActualCost, $i, $Errors) {
	if (!is_numeric($ActualCost)) {
		$Errors[$i] = InvalidActualCost;
	}
	return $Errors;
}

/* Verify that the last cost figure is numeric */
function VerifyLastCost($LastCost, $i, $Errors) {
	if (!is_numeric($LastCost)) {
		$Errors[$i] = InvalidLastCost;
	}
	return $Errors;
}

/* Verify that the material cost figure is numeric */
function VerifyMaterialCost($MaterialCost, $i, $Errors) {
	if (!is_numeric($MaterialCost)) {
		$Errors[$i] = InvalidMaterialCost;
	}
	return $Errors;
}

/* Verify that the labour cost figure is numeric */
function VerifyLabourCost($LabourCost, $i, $Errors) {
	if (!is_numeric($LabourCost)) {
		$Errors[$i] = InvalidLabourCost;
	}
	return $Errors;
}

/* Verify that the overhead cost figure is numeric */
function VerifyOverheadCost($OverheadCost, $i, $Errors) {
	if (!is_numeric($OverheadCost)) {
		$Errors[$i] = InvalidOverheadCost;
	}
	return $Errors;
}

/* Verify that the lowest level figure is numeric */
function VerifyLowestLevel($LowestLevel, $i, $Errors) {
	if (!is_numeric($LowestLevel)) {
		$Errors[$i] = InvalidLowestLevel;
	}
	return $Errors;
}

/* Verify that the Discontinued flag is a 1 or 0 */
function VerifyDiscontinued($Discontinued, $i, $Errors) {
	if ($Discontinued != 0 and $Discontinued != 1) {
		$Errors[$i] = InvalidDiscontinued;
	}
	return $Errors;
}

/* Verify that the Controlled flag is a 1 or 0 */
function VerifyControlled($Controlled, $i, $Errors) {
	if ($Controlled != 0 and $Controlled != 1) {
		$Errors[$i] = InvalidControlled;
	}
	return $Errors;
}

/* Verify that the eoq figure is numeric */
function VerifyEOQ($eoq, $i, $Errors) {
	if (!is_numeric($eoq)) {
		$Errors[$i] = InvalidEOQ;
	}
	return $Errors;
}

/* Verify that the volume figure is numeric */
function VerifyVolume($volume, $i, $Errors) {
	if (!is_numeric($volume)) {
		$Errors[$i] = InvalidVolume;
	}
	return $Errors;
}

/* Verify that the kgs figure is numeric */
function VerifyKgs($kgs, $i, $Errors) {
	if (!is_numeric($kgs)) {
		$Errors[$i] = InvalidKgs;
	}
	return $Errors;
}

/* Check that the barcode is 50 characters or less long */
function VerifyBarCode($barcode, $i, $Errors) {
	if (mb_strlen($barcode) > 50) {
		$Errors[$i] = IncorrectBarCodeLength;
	}
	return $Errors;
}

/* Check that the discount category is 2 characters or less long */
function VerifyDiscountCategory($discountcategory, $i, $Errors) {
	if (mb_strlen($discountcategory) > 2) {
		$Errors[$i] = IncorrectDiscountCategory;
	}
	return $Errors;
}

/* Check that the tax category exists*/
function VerifyTaxCatExists($TaxCat, $i, $Errors) {
	$Searchsql = "SELECT count(taxcatid)
					  FROM taxcategories
					  WHERE taxcatid='" . $TaxCat . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] == 0) {
		$Errors[$i] = TaxCategoriesDoesntExist;
	}
	return $Errors;
}

/* Verify that the Serialised flag is a 1 or 0 */
function VerifySerialised($Serialised, $i, $Errors) {
	if ($Serialised != 0 and $Serialised != 1) {
		$Errors[$i] = InvalidSerialised;
	}
	return $Errors;
}

/* Check that the appendfile is 40 characters or less long */
function VerifyAppendFile($appendfile, $i, $Errors) {
	if (mb_strlen($appendfile) > 40) {
		$Errors[$i] = IncorrectAppendFile;
	}
	return $Errors;
}

/* Verify that the Perishable flag is a 1 or 0 */
function VerifyPerishable($Perishable, $i, $Errors) {
	if ($Perishable != 0 and $Perishable != 1) {
		$Errors[$i] = InvalidPerishable;
	}
	return $Errors;
}

/* Verify that the decimal places figure is numeric */
function VerifyDecimalPlaces($DecimalPlaces, $i, $Errors) {
	if (!is_numeric($DecimalPlaces)) {
		$Errors[$i] = InvalidDecmalPlaces;
	}
	return $Errors;
}

function GetCategoryGLCode($CategoryID, $field) {
	$SQL = 'SELECT ' . $field . " FROM stockcategory WHERE categoryid='" . $CategoryID . "'";
	$result = DB_Query($SQL);
	$MyRow = DB_fetch_row($result);
	return $MyRow[0];
}

/* Insert a new stock item in the KwaMoja database. This function takes an
associative array called $StockItemDetails, where the keys are the
names of the fields in the stockmaster table, and the values are the
values to insert. The only mandatory fields are the stockid, description,
long description, category, and tax category
fields. If the other fields aren't set, then the database defaults
are used. The function returns an array called $Errors. The database
is only updated if the $Errors is empty, else the function returns an
array of one to many error codes.
*/
function InsertStockItem($StockItemDetails, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$PageSecurity = 11; //The authorisation required to go to the stock modification script
	if ((!in_array($PageSecurity, $_SESSION['AllowedPageSecurityTokens']))) {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	foreach ($StockItemDetails as $Key => $Value) {
		$StockItemDetails[$Key] = DB_escape_string($Value);
	}
	$Errors = VerifyStockCode($StockItemDetails['stockid'], sizeof($Errors), $Errors);
	$Errors = VerifyStockDescription($StockItemDetails['decription'], sizeof($Errors), $Errors);
	$Errors = VerifyStockLongDescription($StockItemDetails['longdescription'], sizeof($Errors), $Errors);
	if (isset($StockItemDetails['categoryid'])) {
		$Errors = VerifyStockCategoryExists($StockItemDetails['categoryid'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['units'])) {
		$Errors = VerifyUnits($StockItemDetails['units'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['mbflag'])) {
		$Errors = VerifyMBFlag($StockItemDetails['mbflag'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lastcurcostdate'])) {
		$Errors = VerifyLastCurCostDate($StockItemDetails['lastcurcostdate'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['actualcost'])) {
		$Errors = VerifyActualCost($StockItemDetails['actualcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lastcost'])) {
		$Errors = VerifyLastCost($StockItemDetails['lastcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['materialcost'])) {
		$Errors = VerifyMaterialCost($StockItemDetails['materialcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['labourcost'])) {
		$Errors = VerifyLabourCost($StockItemDetails['labourcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['overheadcost'])) {
		$Errors = VerifyOverheadCost($StockItemDetails['overheadcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lowestlevel'])) {
		$Errors = VerifyLowestLevel($StockItemDetails['lowestlevel'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['discontinued'])) {
		$Errors = VerifyDiscontinued($StockItemDetails['discontinued'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['controlled'])) {
		$Errors = VerifyControlled($StockItemDetails['controlled'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['eoq'])) {
		$Errors = VerifyEOQ($StockItemDetails['eoq'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['volume'])) {
		$Errors = VerifyVolume($StockItemDetails['volume'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['grossweight'])) {
		$Errors = VerifyKgs($StockItemDetails['grossweight'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['barcode'])) {
		$Errors = VerifyBarCode($StockItemDetails['barcode'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['discountcategory'])) {
		$Errors = VerifyDiscountCategory($StockItemDetails['discountcategory'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['taxcatid'])) {
		$Errors = VerifyTaxCatExists($StockItemDetails['taxcatid'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['serialised'])) {
		$Errors = VerifySerialised($StockItemDetails['serialised'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['appendfile'])) {
		$Errors = VerifyAppendFile($StockItemDetails['apendfile'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['perishable'])) {
		$Errors = VerifyPerishable($StockItemDetails['perishable'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['decimalplaces'])) {
		$Errors = VerifyDecimalPlaces($StockItemDetails['decimalplaces'], sizeof($Errors), $Errors);
	}
	$FieldNames = '';
	$FieldValues = '';
	foreach ($StockItemDetails as $Key => $Value) {
		$FieldNames .= $Key . ', ';
		$FieldValues .= '"' . $Value . '", ';
	}
	if (sizeof($Errors) == 0) {
		$stocksql = 'INSERT INTO stockmaster (' . mb_substr($FieldNames, 0, -2) . ') ' . 'VALUES (' . mb_substr($FieldValues, 0, -2) . ') ';
		$locsql = "INSERT INTO locstock (loccode,stockid)
				SELECT locations.loccode,'" . $StockItemDetails['stockid'] . "' FROM locations";
		DB_Txn_Begin();
		$stockresult = DB_Query($stocksql);
		$locresult = DB_Query($locsql);
		DB_Txn_Commit();
		if (DB_error_no() != 0) {
			$Errors[0] = DatabaseUpdateFailed;
		} else {
			$Errors[0] = 0;
		}
	}
	return $Errors;
}

/* Update a stock item in the KwaMoja database. This function takes an
associative array called $StockItemDetails, where the keys are the
names of the fields in the stockmaster table, and the values are the
values to update. The only mandatory fields are the stockid, description,
long description, category, and tax category
fields. If the other fields aren't set, then the database defaults
are used. The function returns an array called $Errors. The database
is only updated if the $Errors is empty, else the function returns an
array of one to many error codes.
*/
function ModifyStockItem($StockItemDetails, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	foreach ($StockItemDetails as $Key => $Value) {
		$StockItemDetails[$Key] = DB_escape_string($Value);
	}
	$Errors = VerifyStockCodeExists($StockItemDetails['stockid'], sizeof($Errors), $Errors);
	if (in_array(StockCodeDoesntExist, $Errors)) {
		return $Errors;
	}
	if (isset($StockItemDetails['description'])) {
		$Errors = VerifyStockDescription($StockItemDetails['decription'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['longdescription'])) {
		$Errors = VerifyStockLongDescription($StockItemDetails['longdescription'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['categoryid'])) {
		$Errors = VerifyStockCategoryExists($StockItemDetails['categoryid'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['units'])) {
		$Errors = VerifyUnits($StockItemDetails['units'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['mbflag'])) {
		$Errors = VerifyMBFlag($StockItemDetails['mbflag'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lastcurcostdate'])) {
		$Errors = VerifyLastCurCostDate($StockItemDetails['lascurcostdate'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['actualcost'])) {
		$Errors = VerifyActualCost($StockItemDetails['actualcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lastcost'])) {
		$Errors = VerifyLastCost($StockItemDetails['lastcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['materialcost'])) {
		$Errors = VerifyMaterialCost($StockItemDetails['materialcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['labourcost'])) {
		$Errors = VerifyLabourCost($StockItemDetails['labourcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['overheadcost'])) {
		$Errors = VerifyOverheadCost($StockItemDetails['overheadcost'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['lowestlevel'])) {
		$Errors = VerifyLowestLevel($StockItemDetails['lowestlevel'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['discontinued'])) {
		$Errors = VerifyDiscontinued($StockItemDetails['discontinued'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['controlled'])) {
		$Errors = VerifyControlled($StockItemDetails['controlled'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['eoq'])) {
		$Errors = VerifyEOQ($StockItemDetails['eoq'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['volume'])) {
		$Errors = VerifyVolume($StockItemDetails['volume'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['grossweight'])) {
		$Errors = VerifyKgs($StockItemDetails['grossweight'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['barcode'])) {
		$Errors = VerifyBarCode($StockItemDetails['barcode'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['discountcategory'])) {
		$Errors = VerifyDiscountCategory($StockItemDetails['discountcategory'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['taxcatid'])) {
		$Errors = VerifyTaxCatExists($StockItemDetails['taxcatid'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['serialised'])) {
		$Errors = VerifySerialised($StockItemDetails['serialised'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['appendfile'])) {
		$Errors = VerifyApendFile($StockItemDetails['apendfile'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['perishable'])) {
		$Errors = VerifyPerishable($StockItemDetails['perishable'], sizeof($Errors), $Errors);
	}
	if (isset($StockItemDetails['decimalplaces'])) {
		$Errors = VerifyDecimalPlaces($StockItemDetails['decimalplaces'], sizeof($Errors), $Errors);
	}
	$SQL = 'UPDATE stockmaster SET ';
	foreach ($StockItemDetails as $Key => $Value) {
		$SQL .= $Key . '="' . $Value . '", ';
	}
	$SQL = mb_substr($SQL, 0, -2) . " WHERE stockid='" . $StockItemDetails['stockid'] . "'";
	if (sizeof($Errors) == 0) {
		$result = DB_Query($SQL);
		echo DB_error_no();
		if (DB_error_no() != 0) {
			$Errors[0] = DatabaseUpdateFailed;
		} else {
			$Errors[0] = 0;
		}
	}
	return $Errors;
}

/* This function takes a stock code and returns an associative array containing
the database record for that item. If the stock item number doesn't exist
then it returns an $Errors array.
*/
function GetStockItem($StockId, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT * FROM stockmaster WHERE stockid='" . $StockId . "'";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		$Errors[0] = 0;
		$Errors[1] = DB_fetch_array($result);
		return $Errors;
	} else {
		return $Errors;
	}
}

/* This function takes a field name, and a string, and then returns an
array of stockids that fulfill this criteria.
*/
function SearchStockItems($Field, $Criteria, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$SQL = "SELECT stockid
			  FROM stockmaster
			  WHERE " . $Field . " LIKE '%" . $Criteria . "%'";
	$result = DB_Query($SQL);
	$i = 0;
	$StockItemList = array();
	while ($MyRow = DB_fetch_array($result)) {
		$StockItemList[$i] = $MyRow[0];
		$i++;
	}
	if (sizeof($Errors) == 0) {
		$Errors[0] = 0;
		$Errors[1] = $StockItemList;
		return $Errors;
	} else {
		return $Errors;
	}
}

function GetStockBalance($StockId, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT quantity,
					 loccode
			   FROM locstock WHERE stockid='" . $StockId . "'";
	$result = api_DB_query($SQL);
	if (sizeof($Errors) == 0) {
		$i = 0;
		while ($MyRow = DB_fetch_array($result)) {
			$answer[$i]['quantity'] = $MyRow['quantity'];
			$answer[$i]['loccode'] = $MyRow['loccode'];
			$i++;
		}
		$Errors[0] = 0;
		$Errors[1] = $answer;
		return $Errors;
	} else {
		return $Errors;
	}
}

function GetStockReorderLevel($StockId, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT reorderlevel, loccode FROM locstock WHERE stockid='" . $StockId . "'";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		$i = 0;
		while ($MyRow = DB_fetch_array($result)) {
			$answer[$i]['reorderlevel'] = $MyRow['reorderlevel'];
			$answer[$i]['loccode'] = $MyRow['loccode'];
			$i++;
		}
		$Errors[0] = 0;
		$Errors[1] = $answer;
		return $Errors;
	} else {
		return $Errors;
	}
}

function SetStockReorderLevel($StockId, $Location, $ReorderLevel, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "UPDATE locstock SET reorderlevel='" . $ReorderLevel . "'
					 WHERE stockid='" . $StockId . "'
					 AND loccode='" . $Location . "'";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		return 0;
	} else {
		return $Errors;
	}
}

function GetAllocatedStock($StockId, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT sum(quantity)
			 FROM salesorderdetails
			 WHERE stkcode='" . $StockId . "'
			 AND completed=0";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		$Errors[0] = 0;
		$Errors[1] = DB_fetch_array($result);
		return $Errors;
	} else {
		return $Errors;
	}
}

function GetOrderedStock($StockId, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT sum(quantityord-quantityrecd)
			  FROM purchorderdetails
			  WHERE itemcode='" . $StockId . "'
			  AND completed=0";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		$Errors[0] = 0;
		$Errors[1] = DB_fetch_array($result);
		return $Errors;
	} else {
		return $Errors;
	}
}

function SetStockPrice($StockId, $Currency, $SalesType, $Price, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	$Errors = VerifyCurrencyCode($Currency, sizeof($Errors), $Errors);
	$Errors = VerifySalesType($SalesType, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT COUNT(*) FROM prices
				 WHERE stockid='" . $StockId . "'
				 and typeabbrev='" . $SalesType . "'
				 and currabrev='" . $Currency . "'";
	$result = DB_Query($SQL);
	$MyRow = DB_fetch_row($result);
	if ($MyRow[0] == 0) {
		$SQL = "INSERT INTO prices VALUES('" . $StockId . "',
											'" . $SalesType . "',
											'" . $Currency . "',
											'',
											'" . $Price . "',
											'')";
	} else {
		$SQL = 'UPDATE prices SET price=' . $Price . " WHERE  stockid='" . $StockId . "'
					AND typeabbrev='" . $SalesType . "'
					AND currabrev='" . $Currency . "'";
	}
	$result = DB_Query($SQL);
	$Errors[0] = 0;
	return $Errors;
}

function GetStockPrice($StockId, $Currency, $SalesType, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	$Errors = VerifyCurrencyCode($Currency, sizeof($Errors), $Errors);
	$Errors = VerifySalesType($SalesType, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT COUNT(*) FROM prices
				 WHERE stockid='" . $StockId . "'
				 AND typeabbrev='" . $SalesType . "'
				 AND currabrev='" . $Currency . "'
				 AND startdate<=CURRENT_DATE
				 AND (enddate>CURRENT_DATE OR enddate='0000-00-00')";
	$result = DB_Query($SQL);
	$MyRow = DB_fetch_row($result);
	if ($MyRow[0] == 0) {
		$Errors[0] = NoPricesSetup;
		return $Errors;
	} else {
		$SQL = "SELECT price FROM prices
							WHERE stockid='" . $StockId . "'
							 AND typeabbrev='" . $SalesType . "'
							 AND currabrev='" . $Currency . "'
							 AND startdate<=CURRENT_DATE
							 AND (enddate>CURRENT_DATE OR enddate='0000-00-00')";
	}
	$result = DB_Query($SQL);
	$MyRow = DB_fetch_row($result);
	$Errors[0] = 0;
	$Errors[1] = $MyRow;
	return $Errors;
}

function GetStockTaxRate($StockId, $TaxAuth, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT taxrate FROM taxauthrates LEFT JOIN stockmaster
				ON taxauthrates.taxcatid=stockmaster.taxcatid
				WHERE stockid='" . $StockId . "'
				AND taxauthority='" . $TaxAuth . "'";
	$result = DB_Query($SQL);
	$MyRow = DB_fetch_row($result);
	$Errors[0] = 0;
	$Errors[1] = $MyRow;
	return $Errors;
}

function StockAdjustment($StockId, $Location, $Quantity, $TranDate, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	$balances = GetStockBalance($StockId, $user, $password);
	$balance = 0;
	for ($i = 0; $i < sizeof($balances); $i++) {
		$balance = $balance + $balances[$i]['quantity'];
	}
	$newqoh = $Quantity + $balance;
	$itemdetails = GetStockItem($StockId, $user, $password);
	$adjglact = GetCategoryGLCode($itemdetails[1]['categoryid'], 'adjglact');
	$stockact = GetCategoryGLCode($itemdetails[1]['categoryid'], 'stockact');

	$stockmovesql = "INSERT INTO stockmoves (stockid,
											   type,
											   transno,
											   loccode,
											   trandate,
											   prd,
											   reference,
											   qty,
											   newqoh)
							   VALUES ('" . $StockId . "',
									   '17',
									   '" . GetNextTransactionNo(17) . "',
									   '" . $Location . "',
									   '" . $TranDate . "',
									   '" . GetPeriodFromTransactionDate($TranDate, sizeof($Errors), $Errors) . "',
									   'api adjustment',
									   '" . $Quantity . "',
									   '" . $newqoh . "')";
	$locstocksql = 'UPDATE locstock SET quantity = quantity + ' . $Quantity . "
							 WHERE loccode='" . $Location . "'
							 AND stockid='" . $StockId . "'";
	$glupdatesql1 = "INSERT INTO gltrans (type,
											typeno,
											trandate,
											periodno,
											account,
											amount,
											narrative)
									VALUES ('17',
										   '" . GetNextTransactionNo(17) . "',
										   '" . $TranDate . "',
										   '" . GetPeriodFromTransactionDate($TranDate, sizeof($Errors), $Errors) . "',
										   '" . $adjglact . "',
										   '" . $itemdetails['materialcost'] * -$Quantity . "',
										   '" . $StockId . ' x ' . $Quantity . ' @ ' . $itemdetails['materialcost'] . "')";
	$glupdatesql2 = "INSERT INTO gltrans (type,
											typeno,
											trandate,
											periodno,
											account,
											amount,
											narrative)
						VALUES ('17',
						'" . GetNextTransactionNo(17) . "',
						'" . $TranDate . "',
						'" . GetPeriodFromTransactionDate($TranDate, sizeof($Errors), $Errors) . "',
						'" . $stockact . "',
						'" . $itemdetails['materialcost'] * $Quantity . "',
						'" . $StockId . ' x ' . $Quantity . ' @ ' . $itemdetails['materialcost'] . "')";
	$systypessql = "UPDATE systypes set typeno='" . GetNextTransactionNo(17) . "' where typeid='17'";

	DB_Txn_Begin();
	api_DB_query($stockmovesql);
	api_DB_query($locstocksql);
	api_DB_query($glupdatesql1);
	api_DB_query($glupdatesql2);
	api_DB_query($systypessql);
	DB_Txn_Commit();
	if (DB_error_no() != 0) {
		$Errors[0] = DatabaseUpdateFailed;
		return $Errors;
	} else {
		return 0;
	}
}

function GetBatches($StockId, $Location, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$Errors = VerifyStockCodeExists($StockId, sizeof($Errors), $Errors);
	$Errors = VerifyStockLocation($Location, sizeof($Errors), $Errors);
	if (sizeof($Errors) != 0) {
		return $Errors;
	}
	$SQL = "SELECT stockserialitems.stockid,
				loccode,
				stockserialitems.serialno as batchno,
				quantity,
				t.price as itemcost
			FROM stockserialitems JOIN (SELECT stockmoves.stockid,
										stockmoves.price,
										stockserialmoves.serialno
										FROM stockmoves JOIN stockserialmoves
										ON stockmoves.stkmoveno=stockserialmoves.stockmoveno
										WHERE stockmoves.type=25) as t
				ON stockserialitems.stockid=t.stockid and stockserialitems.serialno=t.serialno
			WHERE stockid='" . $StockId . "' AND loccode='" . $Location . "'";
	$result = DB_Query($SQL);
	if (sizeof($Errors) == 0) {
		$i = 0;
		while ($MyRow = DB_fetch_array($result)) {
			$answer[$i] = $MyRow;
			$i++;
		}
		return $answer;
	} else {
		return $Errors;
	}
}

?>