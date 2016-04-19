<?php



/**
 * This class defines the structure of the 'foliolist' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.cobra.map
 */
class FoliolistTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.FoliolistTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('foliolist');
        $this->setPhpName('Foliolist');
        $this->setClassname('Foliolist');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('cliente', 'Cliente', 'VARCHAR', true, 255, null);
        $this->addPrimaryKey('folio', 'Folio', 'INTEGER', true, null, null);
        $this->addColumn('enviado', 'Enviado', 'BOOLEAN', true, 1, false);
        $this->addColumn('upda', 'Upda', 'INTEGER', false, null, 0);
        $this->addColumn('crear', 'Crear', 'CHAR', true, null, '');
        $this->addColumn('cuenta', 'Cuenta', 'VARCHAR', true, 255, '');
        $this->addColumn('nombre_deudor', 'NombreDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('capital', 'Capital', 'DECIMAL', true, null, 0);
        $this->addColumn('saldo_can', 'SaldoCan', 'DECIMAL', true, null, 0);
        $this->addColumn('mora', 'Mora', 'INTEGER', true, null, 0);
        $this->addColumn('n_prom', 'NProm', 'DECIMAL', false, null, null);
        $this->addColumn('d_prom1', 'DProm1', 'DATE', false, null, null);
        $this->addColumn('n_prom1', 'NProm1', 'DECIMAL', false, null, null);
        $this->addColumn('d_prom2', 'DProm2', 'DATE', false, null, null);
        $this->addColumn('n_prom2', 'NProm2', 'DECIMAL', false, null, null);
        $this->addColumn('cuenta_concentradora_1', 'CuentaConcentradora1', 'VARCHAR', false, 25, null);
        $this->addColumn('d_fech', 'DFech', 'DATE', false, null, null);
        $this->addColumn('id_cuenta', 'IdCuenta', 'INTEGER', true, null, 0);
        $this->addColumn('cnp', 'Cnp', 'VARCHAR', false, 255, null);
        $this->addColumn('auto', 'Auto', 'INTEGER', true, null, 0);
        $this->addColumn('ciudad_deudor', 'CiudadDeudor', 'VARCHAR', false, 255, null);
        $this->addColumn('estado_deudor', 'EstadoDeudor', 'VARCHAR', false, 25, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', false, 255, null);
        $this->addColumn('sdc', 'Sdc', 'VARCHAR', false, 50, null);
        $this->addColumn('upd', 'Upd', 'CHAR', true, null, '');
        $this->addColumn('c_prom', 'CProm', 'VARCHAR', false, 255, null);
        $this->addColumn('c_freq', 'CFreq', 'VARCHAR', false, 20, null);
        $this->addColumn('diff', 'Diff', 'INTEGER', false, 7, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // FoliolistTableMap
