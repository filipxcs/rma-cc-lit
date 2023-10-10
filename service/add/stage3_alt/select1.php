<html>
<head>
<title>Top1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../../params.php");
require("../../../oracle.php");
require("../../../mysql.php");
$query="SELECT id,date_format(rma_date,'%d-%c-%Y')AS 'rma_date',users,pelaths,kodikos_eidous,posotita,timologio_agoras,date_format(dc,'%d-%c-%Y')AS 'dc',logos_epistrofis,kathari_aksia_pistosis,aksia_polisis FROM sales_stage1 where  id='$_POST[rma]%' AND part='1' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	
        $id=mysql_result($result,$i,"id");
	$rma_date=mysql_result($result,$i,"rma_date");
        $users=mysql_result($result,$i,"users");
	$pelaths=mysql_result($result,$i,"pelaths");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
        $posotita=mysql_result($result,$i,"posotita");
        $timologio_agoras=mysql_result($result,$i,"timologio_agoras");
	$dc=mysql_result($result,$i,"dc");
	$logos_epistrofis=mysql_result($result,$i,"logos_epistrofis");
	$kathari_aksia_pistosis=mysql_result($result,$i,"kathari_aksia_pistosis");
        $aksia_polisis=mysql_result($result,$i,"aksia_polisis");
}
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php 
 $cmdstr = "SELECT SLD.DOCEKDOSISDATE, SDT.DOTCODE, SLD.DOCNUMBER FROM SLD, SSD, CUS, LEE, sdt
WHERE SLD.traid=CUS.traid
AND CUS.leeid=LEE.leeid
AND LEE.leename='$pelaths'
AND SLD.docid=SSD.docid
AND SSD.codcode='$kodikos_eidous'
AND SLD.tdoqtya<>SLD.tdotransfqtya
AND SLD.doccancelstatus='N'
and sld.dotid=sdt.dotid
and sld.fiyid>200601001
AND sdt.ttyidstock in (select stt.ttyid from stt, sdt, siu, sif
where stt.ttyid=sdt.ttyidstock
and stt.ttyid=siu.ttyid
and siu.acuid=sif.acuid
and sif.ttyid=stt.ttyid
and stt.ttyactive=1
and siu.actid in (36,135)
and siu.acuoperator='-1') ";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
	$docekdosisdate=$results["DOCEKDOSISDATE"][$i];
        $dotcode=$results["DOTCODE"][$i];
        $docnumber=$results["DOCNUMBER"][$i];
       
$test=strlen($ttycode);
if (strlen($dotcode)=="3")
{
$dotcode1=$dotcode."&nbsp;&nbsp;";
} 
else if (strlen($dotcode)=="5")
{
$dotcode1=$dotcode;
}

	$display_block.="<OPTION value=\"$docekdosisdate-$dotcode-$docnumber\">$docekdosisdate&nbsp;&nbsp;$dotcode&nbsp;&nbsp;$docnumber</OPTION>";
	}
?>
<input name="id" type="hidden" value="<?php print $id?>">
<SELECT name="ppp" size="6" >
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
  </body>
</html>
