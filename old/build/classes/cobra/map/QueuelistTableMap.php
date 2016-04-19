<?php



/**
 * This class defines the structure of the 'queuelist' table.
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
class QueuelistTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'cobra.map.QueuelistTableMap';

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
        $this->setName('queuelist');
        $this->setPhpName('Queuelist');
        $this->setClassname('Queuelist');
        $this->setPackage('cobra');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('auto', 'Auto', 'INTEGER', true, null, null);
        $this->addColumn('gestor', 'Gestor', 'VARCHAR', true, 255, null);
        $this->addColumn('cliente', 'Cliente', 'VARCHAR', true, 80, null);
        $this->addColumn('status_aarsa', 'StatusAarsa', 'VARCHAR', true, 255, '.');
        $this->addColumn('camp', 'Camp', 'INTEGER', true, null, 0);
        $this->addColumn('orden1', 'Orden1', 'VARCHAR', true, 255, 'id_cuenta');
        $this->addColumn('updown1', 'Updown1', 'BOOLEAN', true, 1, false);
        $this->addColumn('orden2', 'Orden2', 'VARCHAR', false, 255, null);
        $this->addColumn('updown2', 'Updown2', 'BOOLEAN', true, 1, false);
        $this->addColumn('orden3', 'Orden3', 'VARCHAR', false, 255, null);
        $this->addColumn('updown3', 'Updown3', 'BOOLEAN', true, 1, false);
        $this->addColumn('sdc', 'Sdc', 'VARCHAR', false, 80, null);
        $this->addColumn('bloqueado', 'Bloqueado', 'BOOLEAN', true, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // QueuelistTableMap
