# Update FUG x 3 (90% coverage)
update resumen,historia
set fecha_ultima_gestion = concat(d_fech,' ',c_hrin)
where id_cuenta=c_cont
and fecha_ultima_gestion < d_fech
and c_msge is null
and c_visit is null:
update resumen,historia
set fecha_ultima_gestion = concat(d_fech,' ',c_hrin)
where id_cuenta=c_cont
and fecha_ultima_gestion < concat(d_fech,' ',c_hrin)
and c_msge is null
and c_visit is null:
update resumen,historia
set fecha_ultima_gestion = concat(d_fech,' ',c_hrin)
where id_cuenta=c_cont
and fecha_ultima_gestion < concat(d_fech,' ',c_hrin)
and c_msge is null
and c_visit is null:
# Unlock yesterday's cuentas
UPDATE resumen
set locker=null, timelock=null 
where timelock<curdate();
# Ignore gestions more than 2 months ago
UPDATE resumen
SET status_aarsa=''
where status_de_credito not regexp '-'
and fecha_ultima_gestion<now() - interval 2 month
and status_aarsa<>'';
# Select best priority value per cuenta in last 2 months
create temporary table bestval
select c_cont,min(v_cc) as mvc
from historia,dictamenes
where d_fech>=last_day(curdate()-interval 2 month)
and c_cvst=dictamen
group by c_cont;
# Select status associated with best priority in last 2 months
create temporary table beststat
select h.c_cont,h.c_cvst
from historia h, dictamenes, bestval b
where d_fech>=last_day(curdate()-interval 2 month)
and c_cvst=dictamen
and h.c_cont = b.c_cont
and v_cc=mvc;
# Set status to best in last 2 months
UPDATE resumen, beststat
set status_aarsa = c_cvst
where c_cont = id_cuenta 
and status_de_credito not regexp '-';
# PAGO TOTAL is forever
update resumen,historia
set status_aarsa = 'PAGO TOTAL'
where c_cont=id_cuenta
and c_cvst = 'PAGO TOTAL'
and status_de_credito not regexp '-';
# PAGO TOTAL - MULTIPLES PAGOS is forever
update resumen,historia
set status_aarsa = 'PAGO TOTAL - MULTIPLES PAGOS'
where c_cont=id_cuenta
and c_cvst = 'PAGO TOTAL - MULTIPLES PAGOS'
and status_de_credito not regexp '-';
# Was PROMESA, after d_prom, so now PROMESA INCUMPLIDA
update resumen
set status_aarsa = 'PROMESA INCUMPLIDA'
where status_aarsa like 'PROMESA DE%'
and status_de_credito not regexp '-'
and not exists (select * from historia where id_cuenta=c_cont and d_prom>=curdate());
# Except if pago after actualization >= sd2 (PAGO TOTAL)
UPDATE
    resumen,pagos
SET 
    status_aarsa='PAGO TOTAL'
WHERE
    status_aarsa = 'PROMESA INCUMPLIDA'
    AND resumen.id_cuenta=pagos.id_cuenta
        AND status_de_credito NOT REGEXP '-'
        and monto>=saldo_descuento_2
        and fecha>fecha_de_actualizacion;
# Or pago after actualization < sd2 (PAGO PARCIAL)
UPDATE
    resumen,pagos
SET 
    status_aarsa='PAGO PARCIAL'
WHERE
    status_aarsa = 'PROMESA INCUMPLIDA'
    AND resumen.id_cuenta=pagos.id_cuenta
        AND status_de_credito NOT REGEXP '-'
        and fecha>fecha_de_actualizacion;
# Clear cellphone queue
delete FROM cobra.callme where tiempo<curdate();
# Remove old rslices (> 1 hour)
delete from rslice where timeuser<now()-interval 1 hour;
# PROMESA HOY IS HOY
UPDATE cobra.resumen set status_aarsa='PROMESA HOY' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and status_aarsa not in ('PAGO TOTAL', 'PAGO TOTAL - MULTIPLES PAGOS')
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom=curdate()) 
and fecha_de_ultimo_pago>last_day(curdate()-interval 1 month);
# Reset queue MANUAL
UPDATE resumen
set especial = 1
where especial > 1
and fecha_de_actualizacion=curdate()-interval 1 day;
