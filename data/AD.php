

<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//http://stden.livejournal.com/178357.html
// Работа с Active Directory
include ("../db.php");
// Получение пользователей из Active Directory
function get_AD_users($adlogin)
{
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

    $base_dn = "DC=$domain1, DC=$domain2";
    //$filter = "(samaccountname=*sstryukov*)";
    $filter = "(&(objectClass=user)(objectCategory=person)(&(name=*)(samaccountname=$adlogin)(displayname=*)(cn=*)))";

    $search = ldap_search($ldap_con, $base_dn, $filter);

    $number_returned = ldap_count_entries($ldap_con, $search); // Количество пользователей
    $info = ldap_get_entries($ldap_con, $search);

    // Результирующий массив с пользователями из AD
    $userinfo = '';
    for ($i = 0; $i < $info["count"]; $i++)
    {
        $user = array();
        $user["login"] = $info[$i]["samaccountname"][0];
        $user["fio"] = $info[$i]["name"][0];
        $user["phone"] = $info[$i]["telephonenumber"][0];
        $user["cab"] = $info[$i]["physicaldeliveryofficename"][0];
        $user["job"] = $info[$i]["title"][0];
        $user["email"] = $info[$i]["mail"][0];
        $job = iconv('utf-8', 'windows-1251', $user["job"]);
        //Добавляем новую должность, если нет
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        $tsql_callSP = "{call addJob( ? )}";
        $params = array(array($job, SQLSRV_PARAM_IN));
        $stmt = sqlsrv_query($conn, $tsql_callSP, $params);
        if ($stmt === false)
        {
            echo "Error in executing statement 1.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_free_stmt( $stmt);  
        sqlsrv_close($conn);
        //
        $user["photo"] = $info[$i]["thumbnailphoto"][0];
        $tmp = explode(" ", $user["fio"]);
        $user["last"] = trim($tmp[0]); // Фамилия
        $user["first"] = @trim($tmp[1]); // Имя
        $user["second"] = @trim($tmp[2]); // Отчество
        if (!in_array($user["login"], $ignore_list))
        {
            $userinfo = $userinfo . $user["last"] . "|" . $user["first"] . "|" . $user["second"] .
                "|" . $user["phone"] . "|" . $user["cab"] . "|" . $user["job"] . "|" .
                base64_encode($user["photo"]) . "|" . $user["email"] . "|";
            //$userinfo = "|".base64_encode($user["photo"])."|";
        }
        ;
    }
    if ($info["count"] < 1)
    {
        $userinfo = -1;
    }
    return $userinfo;
}
;
$userad = $_GET['login'];
echo get_AD_users($userad);

?>