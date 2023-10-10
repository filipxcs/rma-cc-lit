<?
session_start();
?>
<html>
<head>
<title>addrma</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
</script>
</head>

<body bgcolor="#666666">
<img src="images/ramform.jpg" width="800" height="700">
<FORM name=f1  action="inserta.php" method=post>
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
$query2="SELECT * FROM techs";
$query3="SELECT * FROM failr";
$result2=mysql_query($query2);
$result3=mysql_query($query3);
$num=mysql_numrows($result2);
$num3=mysql_numrows($result3);
$date=date("d-m-Y");
$day=date("d");
$month=date("m");
$year=date("Y");
for ($i = 0; $i < $num; $i++ )
	{
	if ($i==$sesid)
	{$techid1="SELECTED";}
	else
	{$techid1="";}
    $techid=mysql_result($result2,$i,"techid");
	$technam=mysql_result($result2,$i,"technam");
	$display_block3.="<OPTION value=\"$techid\" print $techid1>$technam</OPTION>";
	}
	for ($i = 0; $i < $num3; $i++ )
	{
	$failid=mysql_result($result3,$i,"failid");
	$failnam=mysql_result($result3,$i,"failnam");
	$display_block4.="<OPTION value=\"$failid\" >$failnam</OPTION>";
	}
?>

<div id="techs" style="position:absolute; left:38px; top:145px; width:133px; height:30px; z-index:1">
    <select name="techs">
    <? print $display_block3; ?>
  </select>
  </div>
<div id="date" style="position:absolute; left:306px; top:145px; width:152px; height:29px; z-index:2">
<center>
    <? echo $date;?>
</center>
</div>
<div id="eppl" style="position:absolute; left:35px; top:216px; width:185px; height:29px; z-index:2">
<?
if ($_POST[eppl1] == "")
{
echo "<input name=\"eppl\" type=\"text\">";
}
else
{
echo "<input name=\"eppl\" type=\"hidden\" value=\"$_POST[eppl1]\">";
echo $_POST[eppl1];
}
?>  
</div>
<div id="codeeid" style="position:absolute; left:35px; top:286px; width:185px; height:29px; z-index:2">
 <?
 echo "<input name=\"codeeid\" type=\"hidden\" value=\"$_POST[codeeid1]\" >";
 echo $_POST[codeeid1];
 ?>
</div>
<div id="pereid" style="position:absolute; left:306px; top:286px; width:185px; height:29px; z-index:2">
<font size="2">
<?
$db_conn = ocilogon( "s01001", "s01001", "SEN" ); 
$cmdstr = "select * FROM  STI where  CODCODE like '%$_POST[codeeid1]%'";
$cmdstr1 = "SELECT SHVDESCR FROM S01001.SHV";
$parsed = ociparse($db_conn, $cmdstr); 
$parsed1 = ociparse($db_conn, $cmdstr1); 
ociexecute($parsed); 
ociexecute($parsed1); 
$nrows = ocifetchstatement($parsed, $results); 
$nrows1 = ocifetchstatement($parsed1, $results1); 
for ($i = 0; $i < $nrows; $i++ )
	{
	$pereid=$results["ITMNAME"][$i];
	}
for ($ii = 0; $ii < $nrows1; $ii++ )
	{
	if ( $ii=="116") 
       {$ftrans="SELECTED";}
    else 
       {$ftrans="";}
	$trans=$results1["SHVDESCR"][$ii];
	$display_block_trans.="<OPTION value=\"$trans\" print $ftrans>$trans</OPTION>";
	}	
echo $pereid;
echo "<input name=\"pereid1\" type=\"hidden\" value=\"$pereid\" >";

?>
</font>
</div>
<div id="whopl" style="position:absolute; left:306px; top:216px; width:185px; height:29px; z-index:2">
<input name="whopl" type="text" size="30" maxlength="30" onkeypress="return handleEnter(this, event)">    
</div>
<div id="snnb" style="position:absolute; left:547px; top:286px; width:185px; height:29px; z-index:2">
<input name="snnb" type="text" size="25" maxlength="25" onkeypress="return handleEnter(this, event)">    
</div>
<div id="failr" style="position:absolute; left:35px; top:371px; width:177px; height:63px; z-index:2">
<select name="failr" >
      <? print $display_block4; ?>
    </select> 
 </div>
 <div id="failrtext" style="position:absolute; left:215px; top:369px; width:219px; height:63px; z-index:2">
<textarea name="failrtext" cols="30" rows="3" ></textarea>
 </div>
<div id="minchrg" style="position:absolute; left:550px; top:369px; width:159px; height:29px; z-index:2">
<input name="minchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="wrkchrg" style="position:absolute; left:550px; top:395px; width:159px; height:29px; z-index:2">
<input name="wrkchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="partchrg" style="position:absolute; left:550px; top:421px; width:159px; height:29px; z-index:2">
<input name="partchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)"> 
</div>
 <div id="DOA" style="position:absolute; left:35px; top:465px; width:48px; height:29px; z-index:2">
<select name="DOA" >
      <option value="1" >ΝΑΙ</option>
      <option value="2" SELECTED >ΟΧΙ</option>
    </select>    
</div>
<div id="guar" style="position:absolute; left:108px; top:465px; width:48px; height:29px; z-index:2">
<select name="guar">
      <option value="1" SELECTED>Εντός</option>
      <option value="2">Εκτός </option>
    </select>    
</div>
<div id="ypx" style="position:absolute; left:255px; top:465px; width:48px; height:29px; z-index:2">
<select name="ypx">
      <option value="1">ΝΑΙ</option>
      <option value="2" SELECTED>ΟΧΙ</option>
    </select>    
</div>
<div id="dothl" style="position:absolute; left:406px; top:465px; width:48px; height:29px; z-index:2">
<select name="dothl">
      <option value="1">ΝΑΙ</option>
      <option value="2" SELECTED>ΟΧΙ</option>
    </select>    
</div>
<div id="datcour" style="position:absolute; left:520px; top:465px; width:185px; height:29px; z-index:2">
<?
for ($i = 1; $i < 32; $i++ )
	{
	if ($i == $day)
	{$dayf="SELECTED";}
	else 
	{$dayf="";}
		$display_block.="<OPTION value=\"$i\" print $dayf>$i</OPTION>";
	}
	for ($i = 1; $i < 13; $i++ )
	{
	if ($i == $month)
	{$monthf="SELECTED";}
	else 
	{$monthf="";}
		$display_block1.="<OPTION value=\"$i\" print $monthf>$i</OPTION>";
	}
	for ($i = 2004; $i < 2010; $i++ )
	{
	if ($i == $year)
	{$yearf="SELECTED";}
	else 
	{$yearf="";}
		$display_block2.="<OPTION value=\"$i\" print $yearf>$i</OPTION>";
	}
?>	
<select name="datcourD">
<? print $display_block;?>
</select>
<select name="datcourM">
<? print $display_block1;?>
</select>
<select name="datcourY">
<? print $display_block2;?>
</select>
<select name="cour">
<? print $display_block_trans;?>
</select>
</div>
<div id="specs" style="position:absolute; left:35px; top:528px; width:185px; height:72px; z-index:2">
<textarea name="specs" cols="83" rows="4" ></textarea>   
</div>
<div id="submit" style="position:absolute; left:365px; top:644px; width:102px; height:25px; z-index:2">
<input name="submit" type="submit" value="Καταχώρηση">
</div>
</form>
</body>
</html>
