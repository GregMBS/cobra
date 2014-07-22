<?php



/**
 * This class defines the structure of the 'folios' table.
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
class FoliosTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.FoliosTableMap';

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
        $this->setName('folios');
        $this->setPhpName('Folios');
        $this->setClassname('Folios');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('folio', 'Folio', 'INTEGER', true, null, null);
        $this->addColumn('usado', 'Usado', 'BOOLEAN', true, 1, false);
        $this->addColumn('cuenta', 'Cuenta', 'VARCHAR', false, 16, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', false, 255, null);
        $this->addColumn('enviado', 'Enviado', 'BOOLEAN', true, 1, false);
        $this->addColumn('fecha', 'Fecha', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('mora', 'Mora', 'INTEGER', true, null, 0);
        $this->addColumn('capital', 'Capital', 'DECIMAL', true, null, 0);
        $this->addColumn('saldo_can', 'SaldoCan', 'DECIMAL', true, null, 0);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', true, 255, null);
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('mercancia', 'Mercancia', 'TINYINT', true, null, 0);
        $this->addColumn('id', 'Id', 'INTEGER', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // FoliosTableMap
