update resumen,historia,dictamenes d1,dictamenes d2
set status_aarsa=c_cvst
where d_fech>=last_day(curdate()-interval 4 month)
and c_cont=id_cuenta 
and status_aarsa=d1.dictamen
and c_cvst=d2.dictamen
and d2.v_cc<d1.v_cc
and status_de_credito not like '%o';
update resumen
set status_aarsa='PAGO DEL MES ANTERIOR'
where status_aarsa like 'PAG%' and status_aarsa not like 'PAGO TOTAL%'
and id_cuenta in (select id_cuenta from pagos)
and id_cuenta not in (select id_cuenta from pagos where fecha>last_day(curdate()-interval 1 month))
and status_de_credito not like '%o';
update resumen
set status_aarsa='PAGO TOTAL DEL MES ANTERIOR'
where status_de_credito not like '%o'
and status_aarsa='PAGO TOTAL'
and id_cuenta in (select id_cuenta from pagos
where fecha<=last_day(curdate()-interval 1 month))
and id_cuenta in (select c_cont from historia 
where c_cvst='pago total' 
and d_fech<=last_day(curdate()-interval 1 month));
update cobra.resumen set status_aarsa='PROMESA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>=curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom<curdate()) 
and id_cuenta not in 
(select id_cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month) and confirmado=0) 
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');
update cobra.resumen set status_aarsa='PROPUESTA INCUMPLIDA' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom<curdate()) 
and id_cuenta not in 
(select id_cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month))  
and status_aarsa in ('propuesta de pago','propuesta hoy');
delete FROM cobra.callme where tiempo<curdate();
delete from rslice where timeuser<now()-interval 1 hour;
update cobra.resumen set status_aarsa='PROMESA HOY' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom=curdate()) 
and numero_de_cuenta not in 
(select cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month)) 
and status_aarsa not regexp 'rota' and status_aarsa not regexp 'propuesta'
and (status_aarsa like 'PROM%' or status_aarsa like 'CONFIRMA P%');
update cobra.resumen set status_aarsa='PROPUESTA HOY' 
where id_cuenta not in (select c_cont from cobra.historia where n_prom>0 
and d_prom>curdate()) 
and id_cuenta in (select c_cont from cobra.historia where n_prom>0 
and d_prom=curdate()) 
and numero_de_cuenta not in 
(select cuenta from cobra.pagos where fecha>last_day(curdate()-interval 1 month))  
and status_aarsa = 'propuesta de pago';
update resumen,pagos 
set status_aarsa='PAGO TOTAL' 
where status_de_credito like '%ado' 
and fecha_de_actualizacion>last_day(curdate()-interval 1 month) 
and fecha>last_day(curdate()-interval 1 month) 
and pagos.id_cuenta=resumen.id_cuenta
and status_aarsa<>'PAGO TOTAL';
