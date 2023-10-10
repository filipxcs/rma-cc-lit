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
<img src="images/ramform.jpg" width="800" height="992">

<FORM  action="insertc.php" method=post>
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
$query="SELECT id,techs,eppl,whopl,codeeid,pereid,snnb,minchrg,failr,failrtext,wrkchrg,partchrg,DOA,guar,ypx,dothl,cour,specs,part,partc,date_format(date,'%d-%c-%Y')AS 'date',date_format(datcour,'%d-%c-%Y')AS 'datcour' FROM adda WHERE id = '$_POST[item]'";
$query1="SELECT * FROM techs";
$query2="SELECT * FROM cact";
$query3="SELECT minchrg,wrkchrg,partchrg FROM addb WHERE id = '$_POST[item]'";
$result=mysql_query($query);
$result1=mysql_query($query1);
$result2=mysql_query($query2);
$result3=mysql_query($query3);
$num=mysql_numrows($result);
$num1=mysql_numrows($result1);
$num2=mysql_numrows($result2);
$day=date("d");
$month=date("m");
$year=date("Y");
for ($i = 0; $i < $num; $i++ )
	{	
    $aid=mysql_result($result,$i,"id");
	$partc=mysql_result($result,$i,"partc");
	$partnb=mysql_result($result,$i,"part");
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
	$bminchrg=mysql_result($result3,$i,"minchrg");
	$bwrkchrg=mysql_result($result3,$i,"wrkchrg");
	$bpartchrg=mysql_result($result3,$i,"partchrg");
	}
	//--- PART C ----
$quer1="SELECT * FROM addc WHERE id='$_POST[item]'";
$res1=mysql_query($quer1);
$nu1=mysql_numrows($res1);
$querD="SELECT date_format(cdatcour,'%e')AS 'cdatcour'  FROM addc WHERE id='$_POST[item]'";
$resD=mysql_query($querD);
$nuD=mysql_numrows($resD);
$querM="SELECT date_format(cdatcour,'%c')AS 'cdatcour'  FROM addc WHERE id='$_POST[item]'";
$resM=mysql_query($querM);
$querY="SELECT date_format(cdatcour,'%Y')AS 'cdatcour'  FROM addc WHERE id='$_POST[item]'";
$resY=mysql_query($querY);
for ($i = 0; $i < $nu1; $i++ )
	{	
    $emalfun=mysql_result($res1,$i,"malfun");
	$echact=mysql_result($res1,$i,"chact");
	$epartact=mysql_result($res1,$i,"partact");
	$eminchrg=mysql_result($res1,$i,"minchrg");
	$ewrkchrg=mysql_result($res1,$i,"wrkchrg");
	$epartchrg=mysql_result($res1,$i,"partchrg");
	$etechs=mysql_result($res1,$i,"ctechs");
	$edateD=mysql_result($resD,$i,"cdatcour");
	$edateM=mysql_result($resM,$i,"cdatcour");
	$edateY=mysql_result($resY,$i,"cdatcour");
	$efback=mysql_result($res1,$i,"fback");
	$etspecs=mysql_result($res1,$i,"tspecs");
		}
			if ( $efback=="1") 
{$efback1="SELECTED";}
else 
{$efback2="SELECTED";}
if ( $partc=="1") 
{$partcf="checked";}
else 
{$partcf="";}
echo "<input name=\"part\" type=\"hidden\" value=\"$partnb\">";
for ($i= 0; $i < $num1; $i++ )
{
	 if ($i==$etechs)
	{$etechs1="SELECTED";}
	else 
	{$etechs1="";}
    $techid=mysql_result($result1,$i,"techid");
	$technam=mysql_result($result1,$i,"technam");
	$display_block3.="<OPTION value=\"$techid\" print $etechs1>$technam</OPTION>";
	}
//	{
//	if ($i==$sesid)
//	{$techid1="SELECTED";}
//	else
//	{$techid1="";}
//    $techid=mysql_result($result1,$i,"techid");
//	$technam=mysql_result($result1,$i,"technam");
//	$display_block3.="<OPTION value=\"$techid\" print $techid1>$technam</OPTION>";
//	}
for ($i= 0; $i < $num2; $i++ )
	{
	if ($i==$echact)
	{$echact1="SELECTED";}
	else {$echact1="";}
    $cactid=mysql_result($result2,$i,"cactid");
	$cactnam=mysql_result($result2,$i,"cactnam");
	$display_block4.="<OPTION value=\"$cactid\" print $echact1>$cactnam</OPTION>";
	}
$query2a="SELECT * FROM techs WHERE techid='$atechs'";
$result2a=mysql_query($query2a);
for ($i = 0; $i < $num; $i++ )
{$atechnam=mysql_result($result2a,$i,"technam");}
$query3a="SELECT * FROM failr WHERE failid='$afailr'";
$result3a=mysql_query($query3a);
for ($i = 0; $i < $num; $i++ )
{$afailnam=mysql_result($result3a,$i,"failnam");}
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

//------------------------------- PART B VIEW ----------------------------------------------
$queryb="SELECT bDOA,bguar,bypx,btechs,dp,pack,extra,extrams,bspecs,minchrg,wrkchrg,partchrg,date_format(bdatcour,'%e-%c-%Y')AS 'bdatcour'  FROM addb WHERE id='$_POST[item]'";
$resultb=mysql_query($queryb);
$numb=mysql_numrows($resultb);
for ($i = 0; $i < $numb; $i++ )
	{	
    $bDOA=mysql_result($resultb,$i,"bDOA");
	$bguar=mysql_result($resultb,$i,"bguar");
	$bypx=mysql_result($resultb,$i,"bypx");
	$btechs=mysql_result($resultb,$i,"btechs");
	$bdp=mysql_result($resultb,$i,"dp");
	$bpack=mysql_result($resultb,$i,"pack");
	$bextra=mysql_result($resultb,$i,"extra");
	$bextrams=mysql_result($resultb,$i,"extrams");
	$bbspecs=mysql_result($resultb,$i,"bspecs");
	$bminchrg=mysql_result($resultb,$i,"minchrg");
	$bwrkchrg=mysql_result($resultb,$i,"wrkchrg");
	$bpartchrg=mysql_result($resultb,$i,"partchrg");
	$bdatcour=mysql_result($resultb,$i,"bdatcour");
	}
$query2b="SELECT * FROM techs WHERE techid='$btechs'";
$result2b=mysql_query($query2b);
for ($i = 0; $i < $num; $i++ )
{$btechnam=mysql_result($result2b,$i,"technam");}
// ---------- edit vars ------------
if ( $bDOA=="1") 
{$bDOA1="ΝΑΙ";}
else 
{$bDOA1="ΟΧΙ";}
if ( $bguar=="1") 
{$bguar1="Εντός";}
else 
{$bguar1="Εκτός";}
if ( $bypx=="1") 
{$bypx1="ΝΑΙ";}
else 
{$bypx1="ΟΧΙ";}
if ( $bpack=="1") 
{$bpack1="ΝΑΙ";}
else 
{$bpack1="ΟΧΙ";}
if ( $bextra=="1") 
{$bextra1="ΝΑΙ";}
else 
{$bextra1="ΟΧΙ";}	
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
<div id="failr" style="position:absolute; left:560px; top:252px; width:241px; height:39px; z-index:1">
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
<div id="minchrg" style="position:absolute; left:545px; top:142px; width:298px; height:29px; z-index:1">
<?
echo "A :  $aminchrg B: $bminchrg ΣΥΝΟΛΟ :";print $aminchrg+$bminchrg;
?> 
</div>
<div id="minchrg" style="position:absolute; left:545px; top:174px; width:298px; height:29px; z-index:1">
<?
echo "A :  $awrkchrg B: $bwrkchrg ΣΥΝΟΛΟ :";print $awrkchrg+$bwrkchrg;
?> 
</div>
<div id="partchrg" style="position:absolute; left:545px; top:202px; width:298px; height:29px; z-index:1">
<?
echo "A :  $apartchrg B: $bpartchrg ΣΥΝΟΛΟ :";print $apartchrg+$bpartchrg;
?> 
</div>
<div id="bDOA" style="position:absolute; left:34px; top:440px; width:250px; height:29px; z-index:1">
<? echo $bDOA1;?> 
</div>
<div id="bguar" style="position:absolute; left:134px; top:440px; width:250px; height:29px; z-index:1">
<? echo $bguar1;?> 
</div>
<div id="bypx" style="position:absolute; left:274px; top:440px; width:250px; height:29px; z-index:1">
<? echo $bypx1;?> 
</div>
<div id="btechs" style="position:absolute; left:413px; top:440px; width:250px; height:29px; z-index:1">
<? echo $btechnam;?> 
</div>
<div id="bdp" style="position:absolute; left:650px; top:440px; width:250px; height:29px; z-index:1">
<? echo $bdp;?> 
</div>
<div id="bpack" style="position:absolute; left:50px; top:505px; width:250px; height:29px; z-index:1">
<? echo $bpack1;?> 
</div>
<div id="bextra" style="position:absolute; left:150px; top:505px; width:250px; height:29px; z-index:1">
<? echo $bextra1;?> 
</div>
<div id="bextrams" style="position:absolute; left:225px; top:505px; width:364px; height:29px; z-index:1">
<? echo $bextrams;?> 
</div>
<div id="bdatcour" style="position:absolute; left:625px; top:495px; width:180px; height:29px; z-index:1">
<? echo $bdatcour;?> 
</div>
<div id="bspecs" style="position:absolute; left:34px; top:555px; width:364px; height:29px; z-index:1">
<? echo $bbspecs;?> 
</div>
<div id="malfun" style="position:absolute; left:35px; top:660px; width:185px; height:76px; z-index:2">
<textarea name="malfun" cols="33" rows="3" wrap="physical" ><? print $emalfun ?></textarea>   
</div>
<div id="chact" style="position:absolute; left:340px; top:660px; width:228px; height:63px; z-index:2">
<select name="chact" size="4">
      <? print $display_block4;?>
    </select> 
</div>
<div id="partact" style="position:absolute; left:583px; top:660px; width:185px; height:76px; z-index:2">
<textarea name="partact" cols="23" rows="3" wrap="physical" ><? print $epartact ?></textarea>   
</div>
<div id="minchrg" style="position:absolute; left:100px; top:768px; width:105px; height:29px; z-index:2">
<input name="minchrg" type="text" value="<? print $eminchrg ?>" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="wrkchrg" style="position:absolute; left:100px; top:796px; width:107px; height:29px; z-index:2">
<input name="wrkchrg" type="text" value="<? print $ewrkchrg ?>" size="10" maxlength="10" onkeypress="return handleEnter(this, event)">    
</div>
<div id="partchrg" style="position:absolute; left:100px; top:825px; width:109px; height:29px; z-index:2">
<input name="partchrg" type="text" value="<? print $epartchrg ?>" size="10" maxlength="10" onkeypress="return handleEnter(this, event)"> 
</div>
<div id="ctechs" style="position:absolute; left:240px; top:770px; width:133px; height:30px; z-index:1">
    <select name="ctechs">
    <? print $display_block3; ?>
  </select>
  </div>
  <div id="cdatcour" style="position:absolute; left:410px; top:770px; width:163px; height:29px; z-index:2">
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
<div id="fback" style="position:absolute; left:610px; top:770px; width:48px; height:29px; z-index:2">
<select name="fback">
      <option value="1"<? print $efback1 ?>>ΝΑΙ</option>
      <option value="2"<? print $efback2 ?>>ΟΧΙ</option>
    </select>    
</div>
<div id="tspecs" style="position:absolute; left:36px; top:878px; width:185px; height:76px; z-index:2">
<textarea name="tspecs" cols="63" rows="4" wrap="physical" ><? print $etspecs ?></textarea>   
</div>
  <div id="submit" style="position:absolute; left:587px; top:941px; width:122px; height:25px; z-index:2"> 
    <font color="#FFFFFF">Ανοιχτό;</font> <input name="partc" type="checkbox" value="1" <? print $partcf ?>>
</div>
<div id="submit" style="position:absolute; left:710px; top:941px; width:102px; height:25px; z-index:2">
<input name="submit" type="submit" value="Καταχώρηση">
</div>
</form>
</body>
</html>
