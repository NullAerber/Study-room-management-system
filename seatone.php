<HTML>
<HEAD>
<TITLE> 自习室座位管理系统 </TITLE>
</HEAD>
<body>

<table border="0" width="100%" cellpadding="2" height="12">
<tr>
<td width="100%">
      <h3 align=center> 自习室座位管理系统-自习室一</h3>
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


$sql = "SELECT `Id`,`User`,`Enddate` FROM `seatone`";
$result = mysqli_query($connection,$sql);
$nowdate = date('Y-m-d H:i:s',strtotime('+7 hours'));


if($result->num_rows > 0)
{
	echo '<p style = "text-align:center">========================自习室一========================</br><p>';
	while($row = mysqli_fetch_array($result))//获取一行数据并存入一个数组
	{
		$id = $row["Id"];
		//刷新座位表
		if($nowdate > $row["Enddate"])
		{
			$sqlupdate = "UPDATE `seatone` SET `User`='0',`Startdate`='0000-00-00 00:00:00',`Enddate`='0000-00-00 00:00:00' WHERE `Id`='$id'";
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
	echo("<p style='font-size:12pt;text-align:center'>获取座位数据失败！<p>");
}

mysqli_close($connection);

?>

<div style="width:100%;text-align:center">
<form method="POST" action="selectseat.php">
<?php echo "选择座位：";?>
<select name="fullid">
<option value="011">1号座位</option>
<option value="012">2号座位</option>
<option value="013">3号座位</option>
<option value="014">4号座位</option>
<option value="015">5号座位</option>
<option value="016">6号座位</option>
<option value="107">7号座位</option>
<option value="018">8号座位</option>
<option value="019">9号座位</option>
<option value="0110">10号座位</option>
<option value="0111">11号座位</option>
<option value="0112">12号座位</option>
<option value="0113">13号座位</option>
<option value="0114">14号座位</option>
<option value="0115">15号座位</option>
<option value="0116">16号座位</option>
<option value="0117">17号座位</option>
<option value="0118">18号座位</option>
<option value="0119">19号座位</option>
<option value="0120">20号座位</option>
<option value="0121">21号座位</option>
<option value="0122">22号座位</option>
<option value="0123">23号座位</option>
<option value="0124">24号座位</option>
<option value="0125">25号座位</option>
</select>

<p>现在的时间为：<?php echo $nowdate;?>
<p>选择结束时间：<input type="datetime-local" name="enddate"></p>

<input type="submit" value="提交"/>
<input type="reset" value="重置"/>
</form>
</div>

<tr><td align=center>
<a href="index.html"><font color="#008000">返回首页</font></a>
<a href="seatlist.php"><font color="#008000">返回自习室列表</font></a>

</td></tr>
</table>
</body>
</HTML>
