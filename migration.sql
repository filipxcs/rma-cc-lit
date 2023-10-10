---adda

insert into rmamain /*(rmaid, kind, userid, sessionid)*/ 
    select adda.id, '1', if(techs.techid=0,15,techid), '0' 
        from adda, techs 
        where techs.techid=adda.techs;

insert into rmaservice (rmaid,stageid,tracode,leename,codcode,itmname,sn,online,
                    doa,inwar,bumerang,malfconf,noreason,userblame,malfunction,contactname)
    select adda.id, '1', '�������', adda.eppl, adda.codeeid,adda.pereid,adda.snnb,'0',
        adda.doa,adda.guar,'2','0','0','0',
        concat(concat(failures.failnam, ' '),adda.failrtext), if(techs.techid=0,15,techid),
        whopl 
        from adda, techs, failures 
        where techs.techid=adda.techs 
        and adda.fairl=failures.failid;

insert into transactions (rmaid,date,kind,userid,details)
    select adda.id, adda.date, '������', 
    if(techs.techid=0,15,techid), adda.specs 
    from adda, techs 
    where techs.techid=adda.techs;
    
insert into charges (rmaid, userid,date,value,comment)
    select adda.id, if(techs.techid=0,15,techid), adda.date, 
    adda.minchrg+adda.wrkchrg+adda.partchrg, 
    if(adda.minchrg=0,if(adda.wrkchrg=0,if(adda.partchrg=0,'-','���� ������'),'������ ��������'),'�������� ������')
    from adda, techs 
    where techs.techid=adda.techs 
    and adda.minchrg+adda.wrkchrg+adda.partchrg!=0;
        
--- addb
update rmaservice
    set stageid=2
    where rmaid in (select id from addb);

insert into transactions (rmaid,date,kind,userid,details,docdetails)
    select addb.id, addb.bdatcour, '��������', if(addb.btechs=0,15,addb.btechs), 
    addb.bspecs, addb.dp from addb;

insert into package (rmaid, package,included,comments)
    select addb.id, addb.pack, addb.extra, addb.extrams   
    from addb;
    
insert into charges (rmaid, userid,date,value,comment)
    select addb.id, if(techs.techid=0,15,techid), addb.bdatcour, 
    addb.minchrg+addb.wrkchrg+addb.partchrg, 
    if(addb.minchrg=0,if(addb.wrkchrg=0,if(addb.partchrg=0,'-','���� ������'),'������ ��������'),'�������� ������')
    from addb, techs 
    where techs.techid=addb.btechs 
    and addb.minchrg+addb.wrkchrg+addb.partchrg!=0;
    
--- addc
update rmaservice
    set stageid=6
    where rmaid in (select id from addc);

update rmaservice
    set noreason=1
    where rmaid in (select id from addc
                    where fback=1);

insert into transactions (rmaid,date,kind,userid,details)
    select addc.id, addc.cdatcour, '�������', if(addc.ctechs=0,15,ctechs), 
    addc.malfun from addc where addc.malfun is not null;

insert into transactions (rmaid,date,kind,userid,details)
    select addc.id, addc.cdatcour, '�����������',if(addc.ctechs=0,15,ctechs), 
    addc.tspecs from addc;

insert into checks (rmaid, techid, date, checktype, comment)
    select addc.id, if(addc.ctechs=0,15,ctechs), addc.cdatcour, 
    if(addc.chact=0 or addc.chact=1, 4, if(addc.chact=2 or addc.chact=3,5,6)), concat(concat(addc.partact, ' '),addc.tspecs)
    from addc;
    
insert into charges (rmaid, userid,date,value,comment)
    select addc.id, if(addc.ctechs=0,15,ctechs), addc.cdatcour, 
    addc.minchrg+addc.wrkchrg+addc.partchrg, 
    if(addc.minchrg=0,if(addc.wrkchrg=0,if(addc.partchrg=0,'-','���� ������'),'������ ��������'),'�������� ������')
    from addc
    where addc.minchrg+addc.wrkchrg+addc.partchrg!=0;

--- addd
update rmaservice
    set stageid=8
    where rmaid in (select id from addd
                    where addd.da is not null);

insert into transactions (rmaid,date,kind,userid)
    select addd.id, addd.d1datcour, '�����������', if(addd.dtechs=0,15,dtechs)
     from addd where addd.ddatcour!=addd.d1datcour;

insert into transactions (rmaid,date,kind,userid,details,docdetails)
    select addd.id, addd.ddatcour, '��������', if(addd.dtechs=0,15,dtechs), 
    addd.dspecs, addd.da from addd;

insert into charges (rmaid, userid,date,value,comment)
    select addd.id, if(addd.dtechs=0,15,dtechs), addd.ddatcour, 
    addd.minchrg+addd.wrkchrg+addd.partchrg, 
    if(addd.minchrg=0,if(addd.wrkchrg=0,if(addd.partchrg=0,'-','���� ������'),'������ ��������'),'�������� ������')
    from addd
    where addd.minchrg+addd.wrkchrg+addd.partchrg!=0;









