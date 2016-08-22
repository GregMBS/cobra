<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigClass
{
    /**
     * @var PDO $pdo
     */
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    private function getGestorStr($gestor)
    {
        if ($gestor != 'todos') {
            $gestorstr = " and c_cvge = :gestor ";
        } else {
            $gestorstr = "";
        }
        return $gestorstr;
    }

    private function getClienteStr($cliente)
    {
        if ($cliente != 'todos') {
            $clientestr = " and cliente = :cliente ";
        } else {
            $clientestr = "";
        }
        return $clientestr;
    }

    public function getHistoria(
            $queryFront, $queryBack, $fecha1, $fecha2, $gestor, $cliente
            )
    {
        $gestorstr  = $this->getGestorStr($gestor);
        $clientestr = $this->getClienteStr($cliente);
        $query      = $queryFront.$gestorstr.$clientestr.$queryBack;
        $stq        = $this->pdo->prepare($query);
        $stq->bindParam(':fecha1', $fecha1);
        $stq->bindParam(':fecha2', $fecha2);
        if ($gestor != 'todos') {
            $stq->bindParam(':gestor', $gestor);
        }
        if ($cliente != 'todos') {
            $stq->bindParam(':cliente', $cliente);
        }
        $stq->execute();
        $data = $stq->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllPagos($fecha1, $fecha2, $gestor, $cliente)
    {
        $queryFront = "select Status_aarsa AS 'STATUS',ejecutivo_asignado_call_center AS 'GESTOR',
    numero_de_cuenta as 'CUENTA',nombre_deudor as 'NOMBRE',
    saldo_descuento_1 as 'SALDO CAPITAL s/i',saldo_total as 'SALDO TOTAL',
    pagos_vencidos*30 as 'MORA',n_prom as 'TOTAL PROMESA',
    d_prom1 as 'FECHA PROMESA 1',n_prom1 as 'MONTO PROMESA 1',
    d_prom2 as 'FECHA PROMESA 2',n_prom2 as 'MONTO PROMESA 2',
    c_motiv AS 'MOTIVADOR',c_cnp AS 'CAUSA NO PAGO',
    resumen.cliente AS 'CLIENTE',
    status_de_credito AS 'CAMPANA',d_fech AS 'FECHA GESTION',
    max(pagos.fecha) AS 'FECHA PAGO',sum(monto) AS 'MONTO PAGO',max(confirmado) as 'CONFIRMADO'
from resumen join historia on c_cont=id_cuenta
join pagos on numero_de_cuenta=pagos.cuenta and c_cvba=pagos.cliente
where (n_prom>0 or n_prom is null)
and pagos.fecha between :fecha1 and :fecha2
";
        $queryBack  = "and status_de_credito not like '%tivo' and c_cniv is null
group by resumen.id_cuenta ORDER BY d_fech,c_hrin;";
        $data       = $this->getHistoria(
                $queryFront, 
                $queryBack, 
                $fecha1,
                $fecha2, 
                $gestor, 
                $cliente);
        return $data;
    }

    public function getBigGestiones($fecha1, $fecha2, $gestor, $cliente)
    {
        $queryFront = "SELECT numero_de_cuenta as 'cuenta',
        nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento',
    saldo_total,status_aarsa as 'mejor status',h1.*,d2.
    v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,
    pagos.fecha as 'fecha pago',pagos.monto as 'monto pago'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between :fecha1 and :fecha2
";

        $queryBack = ";";
        $data      = $this->getHistoria($queryFront, $queryBack, $fecha1,
            $fecha2, $gestor, $cliente);
        return $data;
    }

    public function getAllGestiones($fecha1, $fecha2, $gestor, $cliente)
    {
        $queryFront = "SELECT numero_de_cuenta,nombre_deudor,
            resumen.cliente,status_de_credito,saldo_total,queue,h1.*
    from resumen join historia h1 on c_cont=id_cuenta
join dictamenes on status_aarsa=dictamen
where d_fech between :fecha1 and :fecha2
";

        $queryBack = "and status_de_credito not like '%tivo'
ORDER BY d_fech,c_hrin
    ;";
        $data      = $this->getHistoria($queryFront, $queryBack, $fecha1,
            $fecha2, $gestor, $cliente);
        return $data;
    }

    public function getGestionDates($direction)
    {
        $query  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 5 week)
        ORDER BY d_fech $direction limit 60";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getPagosDates($direction)
    {
        $query  = "SELECT distinct fecha FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        ORDER BY fecha $direction limit 60";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getGestionClientes()
    {
        $query  = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getPagosClientes()
    {
        $query  = "SELECT distinct cliente FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        limit 10
	";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getGestionGestores()
    {
        $query  = "SELECT distinct c_cvge FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        order by c_cvge
        limit 1000";
        $result = $this->pdo->query($query);
        return $result;
    }

    public function getPagosGestores()
    {
        $query  = "SELECT distinct gestor FROM pagos
        where fecha>last_day(curdate()-interval 2 month)
        order by gestor
        limit 1000";
        $result = $this->pdo->query($query);
        return $result;
    }
}