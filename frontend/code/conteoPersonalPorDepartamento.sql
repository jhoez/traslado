select count(fkdepart)
from comedor.perscomedor
where fkdepart = 1
group by fkdepart
order by fkdepart;

select
nombcompleto,fkuser,nombdepart,
count(fkdepart)
from gt.personal
inner join gt.departamento on gt.departamento.iddepart = gt.personal.fkdepart
where fkuser = 3 and fkdepart = 1
group by fkuser,fkdepart,nombcompleto,nombdepart
order by fkdepart;
