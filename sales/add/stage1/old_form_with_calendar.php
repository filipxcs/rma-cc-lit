<?php 
session_start();
?>
<html>
  <head>
<title>input</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php 
require("../../../params.php");
$date=date("d/m/Y");
$needle="-";
$domain1 = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$domain1a = substr("$_POST[ppp]",strlen($domain1)+1,strlen($_POST[ppp]));
$domain2 = substr("$domain1a",0,strpos($domain1a,$needle));
$domain2a = substr("$domain1a",strlen($domain2)+1,strlen($domain1a));
$domain3 = substr("$domain2a",0,strpos($domain2a,$needle));
$domain3a = substr("$domain2a",strlen($domain3)+1,strlen($domain2a));
$domain4 = substr("$domain3a",0,strpos($domain3a,$needle));
$domain4a = substr("$domain3a",strlen($domain4)+1,strlen($domain3a));
$domain5 = substr("$domain4a",0,strpos($domain4a,$needle));
$domain5a = substr("$domain4a",strlen($domain5)+1,strlen($domain4a));

$timologio_agoras=$domain1." : ".$domain3." - ".$domain4;

print $domain1;
print "<br>";
print $domain2;
print "<br>";
print $domain3;
print "<br>";
print $domain4;
print "<br>";
print $domain5;
print "<br>";
print $domain5a;
?>
  <body bgcolor=<?php print $colour?>>
    <FORM name="form" action="insert.php" method="post">
      <table border="0">
  <tbody>
    <tr>
      <td width="192"></td>	
      <td width="180"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $_POST[pelaths];?><input name="pelaths" type="hidden" value="<?php print $_POST[pelaths]?>"></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Είδος</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $_POST[kodikos_eidous];?><input name="kodikos_eidous" type="hidden" value="<?php print $_POST[kodikos_eidous]?>"></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $date;?></td>
    </tr>
<tr>
      <td><br> </td>
      <td> </td>
      <td> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><input name="dc" value="" size="11">&nbsp;<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form.dc);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Καθαρή αξία πίστωσης </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><input name="kathari_aksia_pistosis" value="" size="11"> </td>
    </tr>
  </tbody>
</table>
<br>
      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφης </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td width="370"><textarea name="logos_epistrofis" cols="50" rows="2"></textarea> </td>
    </tr>
        </tbody>
</table>
      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"></td>
      <td width="10" valign="top"></td>
      <td width="370" align="right"><input name="submit" type="submit" value="καταχώρηση"></td>
    </tr>
        </tbody>
</table>
</FORM>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</body>
</html>

