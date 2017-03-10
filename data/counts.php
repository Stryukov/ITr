<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//http://stden.livejournal.com/178357.html
// Работа с Active Directory
include ("../db.php");
// Получение пользователей из Active Directory

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
    $filter = "(&(objectClass=computer)(&(name=*)(cn=*)))";
    
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

echo json_encode($counts);  
//echo $number_returned;//. var_dump($info);

?>