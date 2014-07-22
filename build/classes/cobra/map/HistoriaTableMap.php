<?php



/**
 * This class defines the structure of the 'historia' table.
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
class HistoriaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.HistoriaTableMap';

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
        $this->setName('historia');
        $this->setPhpName('Historia');
        $this->setClassname('Historia');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('Auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('C_CVGE', 'CCvge', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CVBA', 'CCvba', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CONT', 'CCont', 'INTEGER', true, null, 0);
        $this->addColumn('C_CVST', 'CCvst', 'VARCHAR', false, 255, null);
        $this->addColumn('D_FECH', 'DFech', 'DATE', false, null, null);
        $this->addColumn('C_HRIN', 'CHrin', 'TIME', false, null, null);
        $this->addColumn('C_HRFI', 'CHrfi', 'TIME', false, null, null);
        $this->addColumn('C_TELE', 'CTele', 'VARCHAR', false, 255, null);
        $this->addColumn('C_MSGE', 'CMsge', 'VARCHAR', false, 255, null);
        $this->addColumn('CUENTA', 'Cuenta', 'VARCHAR', true, 50, '0');
        $this->addColumn('C_OBSE1', 'CObse1', 'VARCHAR', false, 255, null);
        $this->addColumn('C_OBSE2', 'CObse2', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CONTAN', 'CContan', 'VARCHAR', false, 255, null);
        $this->addColumn('C_NSE', 'CNse', 'VARCHAR', false, 255, null);
        $this->addColumn('C_VISIT', 'CVisit', 'VARCHAR', false, 255, null);
        $this->addColumn('C_ATTE', 'CAtte', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CNIV', 'CCniv', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CARG', 'CCarg', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CFAC', 'CCfac', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CPTA', 'CCpta', 'VARCHAR', false, 255, null);
        $this->addColumn('C_RCON', 'CRcon', 'VARCHAR', false, 2, null);
        $this->addColumn('AUTH', 'Auth', 'VARCHAR', false, 255, null);
        $this->addColumn('CARGADO', 'Cargado', 'VARCHAR', false, 255, null);
        $this->addColumn('CUANDO', 'Cuando', 'VARCHAR', false, 255, null);
        $this->addColumn('D_PROM', 'DProm', 'DATE', false, null, null);
        $this->addColumn('C_PROM', 'CProm', 'VARCHAR', false, 255, null);
        $this->addColumn('N_PROM', 'NProm', 'DECIMAL', false, null, null);
        $this->addColumn('C_CALLE1', 'CCalle1', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CALLE2', 'CCalle2', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CNP', 'CCnp', 'VARCHAR', false, 255, null);
        $this->addColumn('C_EMAIL', 'CEmail', 'VARCHAR', false, 255, null);
        $this->addColumn('C_NTEL', 'CNtel', 'VARCHAR', false, 255, null);
        $this->addColumn('C_NDIR', 'CNdir', 'VARCHAR', false, 255, null);
        $this->addColumn('C_FREQ', 'CFreq', 'VARCHAR', false, 20, null);
        $this->addColumn('C_CTIPO', 'CCtipo', 'VARCHAR', false, 255, null);
        $this->addColumn('C_COWN', 'CCown', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CSTAT', 'CCstat', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CREJ', 'CCrej', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CPAT', 'CCpat', 'VARCHAR', false, 255, null);
        $this->addColumn('C_ACCION', 'CAccion', 'VARCHAR', false, 255, null);
        $this->addColumn('C_MOTIV', 'CMotiv', 'VARCHAR', false, 255, null);
        $this->addColumn('C_CAMP', 'CCamp', 'VARCHAR', true, 20, '0');
        $this->addColumn('D_PROM1', 'DProm1', 'DATE', false, null, null);
        $this->addColumn('N_PROM1', 'NProm1', 'DECIMAL', false, null, null);
        $this->addColumn('D_PROM2', 'DProm2', 'DATE', false, null, null);
        $this->addColumn('N_PROM2', 'NProm2', 'DECIMAL', false, null, null);
        $this->addColumn('C_EJE', 'CEje', 'VARCHAR', false, 255, null);
        $this->addColumn('error', 'Error', 'INTEGER', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // HistoriaTableMap
