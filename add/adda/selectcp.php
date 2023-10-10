<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY bgcolor="#333333">

<FORM action="adda.php"  target="mainFrame" method=post>

 <?php                                                                                                          
                                                                                            
putenv("NLS_LANG=GREEK_GREECE.UTF8");
putenv("NLS_CHARACTERSET=UTF8");
$db_conn = ocilogon( "S01001", "S01001", "//192.168.1.199/SEN" ); 
if ($_POST[pel]<> "" )
{
 $cmdstr = "select * FROM  STI where  CODCODE like '%$_POST[pel]%'";                                                                                                            


                                                                                                                 
$parsed = ociparse($db_conn, $cmdstr); 
                                                               
ociexecute($parsed); 

                                                                                           
                                                                                                                  
$nrows = ocifetchstatement($parsed, $results);                                                                    

for ($i = 0; $i < $nrows; $i++ )
	{
	$slp=$results["CODCODE"][$i];
	$sl=$results["ITNAME"][$i];
	$display_block.="<OPTION value=\"$slp\">$slp</OPTION>";
	}
                                    }                                

if ($_POST[pel1]<> "" )
{
$cmdstr1= "select * FROM  lee where LEENAME like '$_POST[pel1]%' or LEEAFM like '$_POST[pel1]%'";                                                         
                                                                                                                  
$parsed1= ociparse($db_conn, $cmdstr1);                                                                            
ociexecute($parsed1);                                                                                              
                                                                                                                  
$nrows1 = ocifetchstatement($parsed1, $results1);                                                                    

for ($i = 0; $i < $nrows1; $i++ )
	{
	$slp1=$results1["LEENAME"][$i];
	$display_block1.="<OPTION value=\"$slp1\">$slp1</OPTION>";
	}	
			}
											                  
?>                                
<SELECT name="codeeid1" size="6">
<? print $display_block; ?>
</SELECT>
<select name="eppl1" size="6">
  <? print $display_block1; ?> 
 </select>
 <?
 echo $sl;
 ?>
 <input name="submit" type="submit" value="�������">
</form>

</BODY>
</html>

