<?
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
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

<FORM  action="insertb.php" method=post>
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
$query="SELECT id,techs,eppl,whopl,codeeid,pereid,snnb,minchrg,failr,failrtext,wrkchrg,partchrg,DOA,guar,ypx,dothl,cour,specs,part,date_format(date,'%d-%c-%Y')AS 'date',date_format(datcour,'%d-%c-%Y')AS 'datcour' FROM adda WHERE id = '$_POST[item]'";
$query1="SELECT * FROM techs";
$result=mysql_query($query);
$result1=mysql_query($query1);
$num=mysql_numrows($result);
$num1=mysql_numrows($result1);
$day=date("d");
$month=date("m");
$year=date("Y");
for ($i = 0; $i < $num; $i++ )
	{	
    $aid=mysql_result($result,$i,"id");
	$atechs=mysql_result($result,$i,"techs");
	$aeppl=mysql_result($result,$i,"eppl");
	$aDOA=mysql_result($result,$i,"DOA");
	$aypx=mysql_result($result,$i,"ypx");
	$aguar=mysql_result($result,$i,"guar");
	$adothl=mysql_result($result,$i,"dothl");
	$afailr=mysql_result($result,$i,"failr");
	$afailrtext=mysql_result($result,$i,"failrtext");
	$adate=mysql_result($result,$i,"date");
	$adatcour=mysql_result($result,$i,"datcour");
	$acour=mysql_result($result,$i,"cour");
	$awhopl=mysql_result($result,$i,"whopl");
	$acodeeid=mysql_result($result,$i,"codeeid");
	$apereid=mysql_result($result,$i,"pereid");
	$asnnb=mysql_result($result,$i,"snnb");
	$aspecs=mysql_result($result,$i,"specs");
	$aminchrg=mysql_result($result,$i,"minchrg");
	$awrkchrg=mysql_result($result,$i,"wrkchrg");
	$apartchrg=mysql_result($result,$i,"partchrg");
	}
for ($i= 0; $i < $num1; $i++ )
	{
	if ($i==$sesid)
	{$techid1="SELECTED";}
	else
	{$techid1="";}
    $techid=mysql_result($result1,$i,"techid");
	$technam=mysql_result($result1,$i,"technam");
	$display_block3.="<OPTION value=\"$techid\" print $techid1>$technam</OPTION>";
	}
$query2="SELECT * FROM techs WHERE techid='$atechs'";
$result2=mysql_query($query2);
for ($i = 0; $i < $num; $i++ )
{$atechnam=mysql_result($result2,$i,"technam");}

$query3="SELECT * FROM failr WHERE failid='$afailr'";
$result3=mysql_query($query3);
for ($i = 0; $i < $num; $i++ )
{$afailnam=mysql_result($result3,$i,"failnam");}

// ---------- edit vars ------------
if ( $aDOA=="1") 
{$aDOA1="ΝΑΙ";}
else 
{$aDOA1="ΟΧΙ";}
if ( $aguar=="1") 
{$aguar1="Εντός";}
else 
{$aguar1="Εκτός";}
if ( $aypx=="1") 
{$aypx1="ΝΑΙ";}
else 
{$aypx1="ΟΧΙ";}
if ( $adothl=="1") 
{$adothl1="ΝΑΙ";}
else 
{$adothl1="ΟΧΙ";}

?>
<div id="eppl" style="position:absolute; left:34px; top:137px; width:236px; height:29px; z-index:1">
<? echo $aeppl;?> 
</div>
<div id="whopl" style="position:absolute; left:238px; top:252px; width:147px; height:29px; z-index:1">
<? echo $awhopl;?> 
</div>
<div id="date" style="position:absolute; left:325px; top:137px; width:113px; height:29px; z-index:1">
<? echo $adate;?> 
</div>
<div id="snnb" style="position:absolute; left:388px; top:252px; width:148px; height:29px; z-index:1">
<? echo $asnnb;?> 
</div>
<div id="DOA" style="position:absolute; left:34px; top:295px; width:148px; height:29px; z-index:1">
<? echo $aDOA1;?> 
</div>
<div id="guar" style="position:absolute; left:114px; top:295px; width:148px; height:29px; z-index:1">
<? echo $aguar1;?> 
</div>
<div id="ypx" style="position:absolute; left:254px; top:295px; width:148px; height:29px; z-index:1">
<? echo $aypx1;?> 
</div>
<div id="dothl" style="position:absolute; left:374px; top:295px; width:148px; height:29px; z-index:1">
<? echo $adothl1;?> 
</div>
<div id="datcour" style="position:absolute; left:34px; top:335px; width:261px; height:50px; z-index:1">
<? echo $adatcour;?>
</br>
<? echo $acour; ?> 
</div>
<div id="specs" style="position:absolute; left:295px; top:335px; width:261px; height:50px; z-index:1">
<? echo $aspecs;?> 
</div>
<div id="techs" style="position:absolute; left:34px; top:252px; width:148px; height:29px; z-index:1">
<? echo $atechnam;?> 
</div>
<div id="failr" style="position:absolute; left:540px; top:252px; width:262px; height:29px; z-index:1">
<? echo $afailnam;?>
</br>
<? echo $afailrtext;?> 
</div>
<div id="id" style="position:absolute; left:592px; top:68px; width:37px; height:29px; z-index:1">
<? echo "<input name=\"bid\" type=\"hidden\" value=\"$aid\">"; echo $aid;?> 
</div>
<div id="codeeid" style="position:absolute; left:34px; top:193px; width:197px; height:29px; z-index:1">
<? echo $acodeeid;?> 
</div>
<div id="pereid" style="position:absolute; left:235px; top:193px; width:250px; height:29px; z-index:1">
<? echo $apereid;?> 
</div>
<div id="minchrg" style="position:absolute; left:545px; top:142px; width:85px; height:29px; z-index:1">
<? echo $aminchrg;?> 
</div>
<div id="minchrg" style="position:absolute; left:545px; top:174px; width:85px; height:29px; z-index:1">
<? echo $awrkchrg;?> 
</div>
<div id="partchrg" style="position:absolute; left:545px; top:202px; width:86px; height:29px; z-index:1">
<? echo $apartchrg;?> 
</div>
<div id="bDOA" style="position:absolute; left:36px; top:419px; width:48px; height:29px; z-index:2">
<select name="bDOA">
      <option value="1">ΝΑΙ</option>
      <option value="2" SELECTED>ΟΧΙ</option>
    </select>    
</div>
<div id="bguar" style="position:absolute; left:108px; top:419px; width:48px; height:29px; z-index:2">
<select name="bguar">
      <option value="1" SELECTED>Εντός</option>
      <option value="2">Εκτός</option>
    </select>    
</div>
<div id="bypx" style="position:absolute; left:242px; top:419px; width:48px; height:29px; z-index:2">
<select name="bypx">
      <option value="1">ΝΑΙ</option>
      <option value="2" SELECTED>ΟΧΙ</option>
    </select>    
</div>
<div id="btechs" style="position:absolute; left:412px; top:419px; width:133px; height:30px; z-index:1">
    <select name="btechs">
    <? print $display_block3; ?>
  </select>
  </div>
  <div id="dp" style="position:absolute; left:595px; top:419px; width:185px; height:29px; z-index:2">
<input name="dp" type="text" size="30" maxlength="30" onkeypress="return handleEnter(this, event)">    
</div>
<div id="pack" style="position:absolute; left:190px; top:486px; width:48px; height:29px; z-index:2">
<select name="pack">
      <option value="1">ΝΑΙ</option>
      <option value="2">ΟΧΙ</option>
    </select>    
</div>
<div id="extra" style="position:absolute; left:329px; top:486px; width:48px; height:29px; z-index:2">
<select name="extra">
      <option value="1">ΝΑΙ</option>
      <option value="2">ΟΧΙ</option>
    </select>    
</div>
<div id="extrams" style="position:absolute; left:483px; top:486px; width:185px; height:72px; z-index:2">
<textarea name="extrams" cols="36" rows="3" wrap="physical" ></textarea>   
</div>
<div id="bdatcour" style="position:absolute; left:25px; top:577px; width:185px; height:29px; z-index:2">
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
</div>
<div id="bspecs" style="position:absolute; left:416px; top:577px; width:185px; height:72px; z-index:2">
<textarea name="bspecs" cols="45" rows="4" wrap="physical" ></textarea>   
</div>
<div id="minchrg" style="position:absolute; left:293px; top:572px; width:66px; height:29px; z-index:2">
<input name="minchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="wrkchrg" style="position:absolute; left:293px; top:596px; width:67px; height:29px; z-index:2">
<input name="wrkchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="partchrg" style="position:absolute; left:293px; top:620px; width:70px; height:29px; z-index:2">
<input name="partchrg" type="text" value="0" size="10" maxlength="10" onkeypress="return handleEnter(this, event)"> 
</div>
  <div id="submit" style="position:absolute; left:670px; top:678px; width:102px; height:25px; z-index:2"> 
    <input name="submit" type="submit" value="Καταχώρηση">
  </div>
</form>
</body>
</html>
