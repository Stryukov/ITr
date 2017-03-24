<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include "../db.php";

$content= array();

$cnf = new cnf;
$ldap_server = $cnf->ldap_server;
$auth_user = $cnf->ldap_user;
$auth_pass = $cnf->ldap_pass;
$domain1 = $cnf->domain1;
$domain2 = $cnf->domain2;

// Set the base dn to search the entire directory.

$base_dn = "OU=adm_users, DC=$domain1, DC=$domain2";

// Show only user persons
$filter = "(&(objectCategory=person)(objectClass=user)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))"; //(&(objectClass=user)(objectCategory=person)(cn=*))  

// Enable to show only users
// $filter = "(&(objectClass=user)(cn=$*))";

// Enable to show everything
// $filter = "(cn=*)";

// connect to server

if (!($connect=@ldap_connect($ldap_server))) {
     die("Could not connect to ldap server");
}

// bind to server

if (!($bind=@ldap_bind($connect, $auth_user, $auth_pass))) {
     die("Unable to bind to server");
}

//if (!($bind=@ldap_bind($connect))) {
//     die("Unable to bind to server");
//}

// search active directory

if (!($search=@ldap_search($connect, $base_dn, $filter))) {
     die("Unable to search ldap server");
}

$number_returned = ldap_count_entries($connect,$search);
ldap_sort($connect, $search, 'lastlogontimestamp');
$info = ldap_get_entries($connect, $search);

for ($i=0; $i</*$info["count"]*/50; $i++) {

			        $dateLargeInt=$info[$i]["lastlogontimestamp"][0]; // nano seconds (yes, nano seconds) since jan 1st 1601
			        $secsAfterADEpoch = $dateLargeInt / (10000000); // seconds since jan 1st 1601
			        $ADToUnixConvertor=((1970-1601) * 365.242190) * 86400; // unix epoch - AD epoch * number of tropical days * seconds in a day
			        $unixTsLastLogon=intval($secsAfterADEpoch-$ADToUnixConvertor); // unix Timestamp version of AD timestamp

   $content[] = array(
      $i+1,
      iconv('windows-1251', 'utf-8', $info[$i]["displayname"][0]),
      $info[$i]["mail"][0],
      $info[$i]["telephonenumber"][0],
      $lastlogon=date("d-m-Y", $unixTsLastLogon)
   );

}


$response = array(
  'aaData' => $content,
  'iTotalRecords' => count($content),
  'iTotalDisplayRecords' => count($content)
);

header('Content-type: application/json'); 
echo json_encode($response);

?>