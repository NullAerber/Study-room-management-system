<HTML>
<HEAD>
<TITLE> 自习室座位管理系统 </TITLE>
</HEAD>
<body>

<table border="0" width="100%" cellpadding="2" height="12">
<tr>
<td width="100%">
      <h3 align=center> 自习室座位管理系统-自习室二</h3>
    </td>
</tr>


<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tms";

$connection = mysqli_connect($host,$user,$password,$dbname);

if(!$connection)
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=seatlist.php'>";
	exit("<p style='font-size:12pt;text-align:center'>连接mysql数据失败！<p>");
}


$sql = "SELECT `Id`,`User`,`Enddate` FROM `seattwo`";
$result = mysqli_query($connection,$sql);
$nowdate = date('Y-m-d H:i:s',strtotime('+7 hours'));


if($result->num_rows > 0)
{
	echo '<p style = "text-align:center">========================自习室二========================</br><p>';
	while($row = mysqli_fetch_array($result))//获取一行数据并存入一个数组
	{
		$id = $row["Id"];
		//刷新座位表程序
		if($nowdate > $row["Enddate"])
		{
			$sqlupdate = "UPDATE `seattwo` SET `User`='0',`Startdate`='0000-00-00 00:00:00',`Enddate`='0000-00-00 00:00:00' WHERE `Id`='$id'";
	        $resultupdate = mysqli_query($connection,$sqlupdate);
            if($resultupdate){}
		}
		
		if($row["User"])
		{
			echo("<p style='font-size:12pt;color:red;text-align:center'>==".$row["Id"]."==<p>");
		}
		if(!$row["User"])
		{
			echo("<p style='font-size:12pt;color:green;text-align:center'>==".$row["Id"]."==<p>");
		}
		if(($row["Id"]%8) == 0)
		{
			echo '<p style = "text-align:center">======================================================</br><p>'; 
		}
	}
}

else
{
	exit("<p style='font-size:12pt;text-align:center'>获取座位数据失败！<p>");
}
mysqli_close($connection);

?>

<tr><td align=center>
<a href="index.html"><font color="#008000">返回首页</font></a>
<a href="lseatlist.php"><font color="#008000">返回自习室列表</font></a>
</td></tr>
</table>
</body>
</HTML>
