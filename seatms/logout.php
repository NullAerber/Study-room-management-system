<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tms";

$connection = mysqli_connect($host,$user,$password,$dbname);


if(!$connection)
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
	exit("<p style='font-size:12pt;text-align:center'>����mysql����ʧ�ܣ�<p>");
}


$sqluser = "SELECT * FROM `userinfo` WHERE `Log_state` = '1'";
$resultuser = mysqli_query($connection,$sqluser);

if($resultuser->num_rows > 0)
{
	$sqlupdate = "UPDATE `userinfo` SET `Log_state`='0' WHERE `Log_state`='1'";
	$resultupdate = mysqli_query($connection,$sqlupdate);
    if($resultupdate)
	{
		echo("<p style='font-size:12pt;text-align:center'>ע���ɹ���<p>");
	}
}

else
{
	echo("<p style='font-size:12pt;text-align:center'>ע��ʧ�ܣ�<p>");
}

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";

mysqli_close($connection);

?>