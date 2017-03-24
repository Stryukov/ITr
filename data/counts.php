<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//http://stden.livejournal.com/178357.html
// Работа с Active Directory
include ("../db.php");
// Получение пользователей из Active Directory
    $content= array();
    $cnf = new cnf;
    $ldap_user = $cnf->ldap_user; // username
    $ldap_pass = $cnf->ldap_pass; // associated password
    $domain_name = $cnf->domain_name; // Имя домена
    $domain1 = $cnf->domain1;
    $domain2 = $cnf->domain2;
    $serverName = $cnf->dbserver; //serverName\instanceName
    $connectionInfo = array( "Database"=>$cnf->dbname, "UID"=>$cnf->dbuser, "PWD"=>$cnf->dbpass);

    // Служебные пользователи, которых не надо показывать
    $ignore_list = array(
        "Guest",
        "IWAM_SERVER",
        "IUSR_SERVER",
        "USER1CV8SERVER",
        "Administrator");

    // Connect to LDAP server
    $ldap_con = ldap_connect($domain_name) or die("Could not connect to LDAP server.");

    // Fix for Windows 2003 AD
    ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);

    // binding to LDAP server
    $ldapbind = ldap_bind($ldap_con, $ldap_user, $ldap_pass) or die("LDAP bind failed...");

    $base_dn = "OU=adm_users, DC=$domain1, DC=$domain2";
    $filter = "(&(objectClass=user)(objectCategory=person)(&(name=*)(samaccountname=*)(displayname=*)(cn=*)))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество пользователей
    $info = ldap_get_entries($ldap_con, $search);

    $counts['uAD'] = $number_returned;

//Сотрудников в ИТр
$stmt = sqlsrv_query($conn,"select count(*) as users from Employees where state <> 0");
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$counts['users'] = $row["users"];
        
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

//количество компов
    $base_dn = "OU=adm_workstation, DC=$domain1, DC=$domain2";
    $filter = "(&(objectClass=computer)(&(name=*)(cn=*)))"; //(&(objectCategory=computer)(operatingSystem=Windows XP Professional)(operatingSystemServicePack=Service Pack 3))

    //(&(objectClass=computer)(&(name=*)(cn=*)))
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество пользователей
    $info = ldap_get_entries($ldap_con, $search);

    $counts['workstations'] = $number_returned;

//количество серверов
    $base_dn = "OU=adm_servers, DC=$domain1, DC=$domain2";
    $filter = "(&(objectClass=computer)(&(name=*)(cn=*)))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество пользователей
    $info = ldap_get_entries($ldap_con, $search);

    $counts['servers'] = $number_returned;    

   $content[] = array(
      'uAD' => $counts['uAD'],
      'users' => $counts['users'],
      'workstations' => $counts['workstations'],
      'servers' => $counts['servers']
   );    

//количество компов с XP 
    $base_dn = "OU=adm_workstation, DC=$domain1, DC=$domain2";
    $filter = "(&(objectCategory=computer)(operatingSystem=Windows XP*)(operatingSystemServicePack=*))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество РМ 
    $info = ldap_get_entries($ldap_con, $search);

    $os['XP'] = $number_returned;

//количество компов с Win7 
    $base_dn = "OU=adm_workstation, DC=$domain1, DC=$domain2";
    $filter = "(&(objectCategory=computer)(operatingSystem=Windows 7*))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество РМ 
    $info = ldap_get_entries($ldap_con, $search);

    $os['Win7'] = $number_returned;

//количество компов с Win8 
    $base_dn = "OU=adm_workstation, DC=$domain1, DC=$domain2";
    $filter = "(&(objectCategory=computer)(operatingSystem=Windows 8*))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество РМ 
    $info = ldap_get_entries($ldap_con, $search);

    $os['Win8'] = $number_returned;

//количество компов с Win10 
    $base_dn = "OU=adm_workstation, DC=$domain1, DC=$domain2";
    $filter = "(&(objectCategory=computer)(operatingSystem=Windows 10*))";
    
//    $justthese = array("ou", "sn", "givenname");

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество РМ 
    $info = ldap_get_entries($ldap_con, $search);

    $os['Win10'] = $number_returned;

   $OScounts[0] = array(
      'label' => 'Windows XP',
      'value' => $os['XP']   ); 
   $OScounts[1] = array(
      'label' => 'Windows 7',
      'value' => $os['Win7'] ); 
   $OScounts[2] = array(
      'label' => 'Windows 8',
      'value' => $os['Win8'] ); 
   $OScounts[3] = array(
      'label' => 'Windows 10',
      'value' => $os['Win10']); 
   $OScounts[4] = array(
      'label' => 'Другие',
      'value' => $counts['workstations']-($os['Win10']+$os['XP']+$os['Win7']+$os['Win8'])  );    
   

$response = array(
  'counts' => $content,
  'os' => $OScounts
);   

echo json_encode($response);  
//echo $number_returned;//. var_dump($info);

?>