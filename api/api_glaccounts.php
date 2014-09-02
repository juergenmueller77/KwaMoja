<?php

/* Check that the account code doesn't already exist'*/
function VerifyAccountCode($AccountCode, $i, $Errors) {
	$Searchsql = "SELECT count(accountcode)
				FROM chartmaster
				WHERE accountcode='" . $AccountCode . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] > 0) {
		$Errors[$i] = GLAccountCodeAlreadyExists;
	}
	return $Errors;
}

/* Check that the account code already exists'*/
function VerifyAccountCodeExists($AccountCode, $i, $Errors) {
	$Searchsql = "SELECT count(accountcode)
				FROM chartmaster
				WHERE accountcode='" . $AccountCode . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] == 0) {
		$Errors[$i] = GLAccountCodeDoesntExists;
	}
	return $Errors;
}

/* Check that the name is 50 characters or less long */
function VerifyAccountName($AccountName, $i, $Errors) {
	if (mb_strlen($AccountName) > 50) {
		$Errors[$i] = IncorrectAccountNameLength;
	}
	return $Errors;
}

/* Check that the account group exists*/
function VerifyAccountGroupExists($AccountGroup, $i, $Errors) {
	$Searchsql = "SELECT count(groupname)
				FROM accountgroups
				WHERE groupname='" . $AccountGroup . "'";
	$SearchResult = api_DB_query($Searchsql);
	$answer = DB_fetch_array($SearchResult);
	if ($answer[0] == 0) {
		$Errors[$i] = AccountGroupDoesntExist;
	}
	return $Errors;
}

function InsertGLAccount($AccountDetails, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	foreach ($AccountDetails as $Key => $Value) {
		$AccountDetails[$Key] = DB_escape_string($Value);
	}
	$Errors = VerifyAccountCode($AccountDetails['accountcode'], sizeof($Errors), $Errors);
	if (isset($AccountDetails['accountname'])) {
		$Errors = VerifyAccountName($AccountDetails['accountname'], sizeof($Errors), $Errors);
	}
	$Errors = VerifyAccountGroupExists($AccountDetails['group_'], sizeof($Errors), $Errors);
	$FieldNames = '';
	$FieldValues = '';
	foreach ($AccountDetails as $Key => $Value) {
		$FieldNames .= $Key . ', ';
		$FieldValues .= '"' . $Value . '", ';
	}
	if (sizeof($Errors) == 0) {
		$SQL = 'INSERT INTO chartmaster (' . mb_substr($FieldNames, 0, -2) . ') ' . "VALUES ('" . mb_substr($FieldValues, 0, -2) . "') ";
		$result = DB_Query($SQL);
		$SQL = 'INSERT INTO chartdetails (accountcode,
							period)
				SELECT ' . $AccountDetails['accountcode'] . ',
					periodno
				FROM periods';
		$result = api_DB_query($SQL, $db, '', '', '', false);
		if (DB_error_no() != 0) {
			$Errors[0] = DatabaseUpdateFailed;
		} else {
			$Errors[0] = 0;
		}
	}
	return $Errors;
}

/* This function returns a list of the general ledger accounts
 * currently setup on KwaMoja
 */

function GetGLAccountList($user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$SQL = 'SELECT chartmaster.accountcode,
					chartmaster.accountname,
					accountgroups.pandl
				FROM chartmaster INNER JOIN accountgroups
				ON chartmaster.group_=accountgroups.groupname
				ORDER BY accountcode';
	$result = api_DB_query($SQL);
	$i = 0;
	while ($MyRow = DB_fetch_array($result)) {
		$GLAccountList[$i]['accountcode'] = $MyRow[0];
		$GLAccountList[$i]['accountname'] = $MyRow[1];
		$GLAccountList[$i]['pandl'] = $MyRow[2];
		$i++;
	}
	return $GLAccountList;
}

/* This function takes as a parameter a general ledger account code
 * and returns an array containing the details of the selected
 * general ledger code.
 */

function GetGLAccountDetails($AccountCode, $user, $password) {
	$Errors = array();
	$db = db($user, $password);
	if (gettype($db) == 'integer') {
		$Errors[0] = NoAuthorisation;
		return $Errors;
	}
	$SQL = "SELECT * FROM chartmaster WHERE accountcode='" . $AccountCode . "'";
	$result = api_DB_query($SQL);
	return DB_fetch_array($result);
}

?>