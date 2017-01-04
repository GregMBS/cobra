<?php

namespace cobra_salsa;

require_once 'classes/BaseClass.php';

class ReporteDiarioClass extends BaseClass {

    /**
     *
     * @var string
     */
    protected $queryrrotas = "create table rrotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,
n_prom3,d_prom3,n_prom4,d_prom4,
c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day) and c_cvst like 'promesa de%'
where fecha> :lbd0
and status_de_credito not regexp '-'";

    /**
     *
     * @var string
     */
    protected $queryrotad = "create table rotad 
        select pauto 
        from rrotas
        group by pauto 
        having count(1)>1";
    
    /**
     *
     * @var string
     */
    protected $querydeldup = "delete from rrotas 
            where pauto = :pauto 
            order by fecha limit 1";

    /**
     *
     * @var string
     */
    protected $queryxrotas = "create table xrotas 
select * from rrotas where hauto>0";

    /**
     *
     * @var string
     */
    protected $queryupdate = "update rrotas r,xrotas as x
set r.hauto=x.hauto,r.c_cvge=x.c_cvge,
r.n_prom1=x.n_prom1,r.d_prom1=x.d_prom1,
r.n_prom2=x.n_prom2,r.d_prom2=x.d_prom2,
r.n_prom3=x.n_prom3,r.d_prom3=x.d_prom3,
r.n_prom4=x.n_prom4,r.d_prom4=x.d_prom4
where r.id_cuenta=x.id_cuenta and r.hauto is null";
    
    /**
     *
     * @var string
     */
    protected $queryparcial = "select hauto,numero_de_cuenta,rrotas.cliente,
status_de_credito,producto,subproducto,q(status_aarsa) as 'queue',
status_aarsa,nombre_deudor,n_prom1+n_prom2+n_prom3+n_prom4 as 'tprom',
n_prom1,d_prom1,n_prom2,d_prom2,
n_prom3,d_prom3,n_prom4,d_prom4,
max(folio)as 'mfolio',c_cvge,monto,rrotas.fecha 
from rrotas
left join folios on rrotas.cliente like 'credito%' and cuenta=numero_de_cuenta
group by hauto,rrotas.cliente,numero_de_cuenta,monto,rrotas.fecha
order by rrotas.cliente,status_de_credito,numero_de_cuenta";
    
    /**
     *
     * @var string
     */
    protected $queryvencido = "select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',
n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
n_prom3 as 'pp3',d_prom3 as 'fpp3',n_prom4 as 'pp4',d_prom4 as 'fpp4',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>:lbd and status_de_credito not like '%inactivo'
and d_prom<curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>:lbd)";
    
    /**
     *
     * @var string
     */
    protected $queryvigente = "select h1.auto,
        concat(h1.CUENTA,' ') as 'numero_de_cuenta',
        resumen.cliente,
        status_de_credito as 'campa&ntilde;a',
        producto,
        subproducto,
        q(status_aarsa) as 'queue',
        status_aarsa as 'status',
        nombre_deudor,
        n_prom as 'Imp. Neg.',
        n_prom1 as 'pp1',
        d_prom1 as 'fpp1',
        n_prom2 as 'pp2',
        d_prom2 as 'fpp2',
        n_prom3 as 'pp3',
        d_prom3 as 'fpp3',
        n_prom4 as 'pp4',
        d_prom4 as 'fpp4',
        folio,
        c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>last_day(curdate()-interval 1 month) and status_de_credito not like '%inactivo'
and d_prom>=curdate() and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>d_fech)";

    /**
     *
     * @var string
     */
    protected $querymake = "CREATE TABLE `cobra4`.`gmbtemp` (
  `gestor` varchar(50)  NOT NULL,
  `cliente` varchar(50)  NOT NULL,
  `sdc` varchar(50)  NOT NULL,
  `producto` varchar(50)  NOT NULL,
  `subproducto` varchar(50)  NOT NULL,
  `vigente` decimal(10,2) DEFAULT 0,
  `vencido` decimal(10,2) DEFAULT 0,
  `pago` decimal(10,2) DEFAULT 0,
  `meta` decimal(10,2)  DEFAULT '1',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) 
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci";

    /**
     *
     * @var string
     */
    protected $querycalc = "update gmbtemp g
set g.meta=1,metap=(pago)/1,
negociado=(vigente+vencido+pago),
cumplimentop=(pago)/(vigente+vencido+pago),
pronostico=((pago)+(vigente*(pago)/(vigente+vencido+pago))),
pronosticop=((pago)+(vigente*(pago)/(vigente+vencido+pago)))/1";

    /**
     *
     * @var array
     */
    public $resultPagos;

    /**
     *
     * @var array
     */
    public $resultVencidos;

    /**
     *
     * @var array
     */
    public $resultVigentes;

    /**
     * 
     * @return string
     */
    protected function last_business_day() {
        $lm = strtotime("-31 day");
        $month = date("n", $lm);
        $year = date("Y", $lm);
        $lbdg = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $wday = date("N", strtotime("$year-$month-$lbdg"));
        if ($wday == 7) {
            $lbdg -= 2;
        }
        if ($wday == 6) {
            $lbdg--;
        }
        $lbd = date("Y-m-d", strtotime("$year-$month-$lbdg"));
        return $lbd;
    }

    /**
     * 
     * @param string $last_business_day
     */
    protected function createPromesasTable($last_business_day) {
        $this->pdo->query('DROP TABLE IF EXISTS rrotas');
        $sta = $this->pdo->prepare($this->queryrrotas);
        $sta->bindParam(':lbd0', $last_business_day);
        $sta->execute();
    }

    /**
     * 
     * @return array
     */
    protected function getDuplicates() {
        $this->pdo->query('DROP TABLE IF EXISTS rotad');
        $this->pdo->query($this->queryrotad);
        $querypauto = "select pauto from rotad";
        $resultpauto = $this->pdo->query($querypauto);
        return $resultpauto;
    }

    /**
     * 
     * @param array $resultpauto
     */
    protected function deleteDuplicates($resultpauto) {
        foreach ($resultpauto as $answerpauto) {
            $pauto = $answerpauto['pauto'];
            $std = $this->pdo->prepare($this->querydeldup);
            $std->bindParam(':pauto', $pauto);
            $std->execute();
        }
    }

    protected function updateMultiples() {
        $this->pdo->query('DROP TABLE IF EXISTS xrotas');
        $this->pdo->query($this->queryxrotas);
        $this->pdo->query($this->queryupdate);
    }

    protected function createAnalysis() {
        $querydrop = "DROP TABLE IF EXISTS `cobra4`.`gmbtemp`;";
        $this->pdo->query($querydrop);
        $this->pdo->query($this->querymake);
        $this->pdo->query($this->querycalc);
    }

    public function buildReport() {
        $lbd = $this->last_business_day();
        $this->createPromesasTable($lbd);
        $duplicates = $this->getDuplicates();
        $this->deleteDuplicates($duplicates);
        $this->updateMultiples();
        $this->createAnalysis();

        $stp = $this->pdo->query($this->queryparcial);
        $this->resultPagos = $stp->fetchAll(\PDO::FETCH_ASSOC);

        $stv = $this->pdo->prepare($this->queryvencido);
        $stv->bindParam(':lbd', $lbd);
        $stv->execute();
        $this->resultVencidos = $stv->fetchAll(\PDO::FETCH_ASSOC);

        $sti = $this->pdo->query($this->queryvigente);
        $this->resultVigentes = $sti->fetchAll(\PDO::FETCH_ASSOC);
        var_dump($this->resultVigentes);
        die();
    }

}
