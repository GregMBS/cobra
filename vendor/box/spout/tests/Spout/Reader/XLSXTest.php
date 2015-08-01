<?php

namespace Box\Spout\Reader;

use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Type;
use Box\Spout\TestUsingResource;

/**
 * Class XLSXTest
 *
 * @package Box\Spout\Reader
 */
class XLSXTest extends \PHPUnit_Framework_TestCase
{
    use TestUsingResource;

    /**
     * @return array
     */
    public function dataProviderForTestReadShouldThrowException()
    {
        return [
            ['/path/to/fake/file.xlsx'],
            ['file_with_no_sheets_in_content_types.xlsx'],
            ['file_corrupted.xlsx'],
        ];
    }

    /**
     * @dataProvider dataProviderForTestReadShouldThrowException
     * @expectedException \Box\Spout\Common\Exception\IOException
     *
     * @param string $filePath
     * @return void
     */
    public function testReadShouldThrowException($filePath)
    {
        $this->getAllRowsForFile($filePath);
    }

    /**
     * @expectedException \Box\Spout\Reader\Exception\ReaderNotOpenedException
     *
     * @return void
     */
    public function testHasNextSheetShouldThrowExceptionIfReaderNotOpened()
    {
        $reader = ReaderFactory::create(Type::XLSX);
        $reader->hasNextSheet();
    }

    /**
     * @expectedException \Box\Spout\Reader\Exception\EndOfWorksheetsReachedException
     *
     * @return void
     */
    public function testNextSheetShouldThrowExceptionIfNoMoreSheetsToRead()
    {
        $fileName = 'one_sheet_with_shared_strings.xlsx';
        $resourcePath = $this->getResourcePath($fileName);

        $reader = ReaderFactory::create(Type::XLSX);
        $reader->open($resourcePath);

        while ($reader->hasNextSheet()) {
            $reader->nextSheet();
        }

        $reader->nextSheet();
    }

    /**
     * @return array
     */
    public function dataProviderForTestReadForAllWorksheets()
    {
        return [
            ['one_sheet_with_shared_strings.xlsx', 5, 5],
            ['one_sheet_with_inline_strings.xlsx', 5, 5],
            ['two_sheets_with_shared_strings.xlsx', 10, 5],
            ['two_sheets_with_inline_strings.xlsx', 10, 5]
        ];
    }

    /**
     * @dataProvider dataProviderForTestReadForAllWorksheets
     *
     * @param string $resourceName
     * @param int $expectedNumOfRows
     * @param int $expectedNumOfCellsPerRow
     * @return void
     */
    public function testReadForAllWorksheets($resourceName, $expectedNumOfRows, $expectedNumOfCellsPerRow)
    {
        $allRows = $this->getAllRowsForFile($resourceName);

        $this->assertEquals($expectedNumOfRows, count($allRows), "There should be $expectedNumOfRows rows");
        foreach ($allRows as $row) {
            $this->assertEquals($expectedNumOfCellsPerRow, count($row), "There should be $expectedNumOfCellsPerRow cells for every row");
        }
    }

    /**
     * @return void
     */
    public function testReadShouldSupportFilesWithoutSharedStringsFile()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_no_shared_strings_file.xlsx');

        $expectedRows = [
            [10, 11],
            [20, 21],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldSupportAllCellTypes()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_all_cell_types.xlsx');

        $expectedRows = [
            [
                's1--A1', 's1--A2',
                false, true,
                \DateTime::createFromFormat('Y-m-d H:i:s', '2015-06-03 13:21:58'),
                \DateTime::createFromFormat('Y-m-d H:i:s', '2015-06-01 00:00:00'),
                10, 10.43,
                null,
                'weird string', // valid 'str' string
                null, // invalid date
            ],
            ['', '', '', '', '', '', '', '', ''],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldKeepEmptyCellsAtTheEndIfDimensionsSpecified()
    {
        $allRows = $this->getAllRowsForFile('sheet_without_dimensions_but_spans_and_empty_cells.xlsx');

        $this->assertEquals(2, count($allRows), 'There should be 2 rows');
        foreach ($allRows as $row) {
            $this->assertEquals(5, count($row), 'There should be 5 cells for every row, because empty rows should be preserved');
        }

        $expectedRows = [
            ['s1--A1', 's1--B1', 's1--C1', 's1--D1', 's1--E1'],
            ['s1--A2', 's1--B2', 's1--C2', '', ''],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldKeepEmptyCellsAtTheEndIfNoDimensionsButSpansSpecified()
    {
        $allRows = $this->getAllRowsForFile('sheet_without_dimensions_and_empty_cells.xlsx');

        $this->assertEquals(2, count($allRows), 'There should be 2 rows');
        $this->assertEquals(5, count($allRows[0]), 'There should be 5 cells in the first row');
        $this->assertEquals(3, count($allRows[1]), 'There should be only 3 cells in the second row, because empty rows at the end should be skip');

        $expectedRows = [
            ['s1--A1', 's1--B1', 's1--C1', 's1--D1', 's1--E1'],
            ['s1--A2', 's1--B2', 's1--C2'],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldSkipEmptyCellsAtTheEndIfDimensionsNotSpecified()
    {
        $allRows = $this->getAllRowsForFile('sheet_without_dimensions_and_empty_cells.xlsx');

        $this->assertEquals(2, count($allRows), 'There should be 2 rows');
        $this->assertEquals(5, count($allRows[0]), 'There should be 5 cells in the first row');
        $this->assertEquals(3, count($allRows[1]), 'There should be only 3 cells in the second row, because empty rows at the end should be skip');

        $expectedRows = [
            ['s1--A1', 's1--B1', 's1--C1', 's1--D1', 's1--E1'],
            ['s1--A2', 's1--B2', 's1--C2'],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldSkipEmptyRows()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_empty_rows.xlsx');

        $this->assertEquals(2, count($allRows), 'There should be only 2 rows, because the empty row is skipped');

        $expectedRows = [
            ['s1--A1', 's1--B1', 's1--C1', 's1--D1', 's1--E1'],
            ['s1--A3', 's1--B3', 's1--C3', 's1--D3', 's1--E3'],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldSupportEmptySharedString()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_empty_shared_string.xlsx');

        $expectedRows = [
            ['s1--A1', '', 's1--C1'],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldPreserveSpaceIfSpecified()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_preserve_space_shared_strings.xlsx');

        $expectedRows = [
            ['  s1--A1', 's1--B1  ', '  s1--C1  '],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @return void
     */
    public function testReadShouldSkipPronunciationData()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_pronunciation.xlsx');

        $expectedRow = ['名前', '一二三四'];
        $this->assertEquals($expectedRow, $allRows[0], 'Pronunciation data should be removed.');
    }


    /**
     * @return array
     */
    public function dataProviderForTestReadShouldBeProtectedAgainstAttacks()
    {
        return [
            ['attack_billion_laughs.xlsx'],
            ['attack_quadratic_blowup.xlsx'],
        ];
    }

    /**
     * @dataProvider dataProviderForTestReadShouldBeProtectedAgainstAttacks
     * @NOTE: The LIBXML_NOENT is used to ACTUALLY substitute entities (and should therefore not be used)
     *
     * @param string $fileName
     * @return void
     */
    public function testReadShouldBeProtectedAgainstAttacks($fileName)
    {
        $startTime = microtime(true);

        try {
            $this->getAllRowsForFile($fileName);
            $this->fail('An exception should have been thrown');
        } catch (IOException $exception) {
            $duration = microtime(true) - $startTime;
            $this->assertLessThan(10, $duration, 'Entities should not be expanded and therefore take more than 10 seconds to be parsed.');

            $expectedMaxMemoryUsage = 30 * 1024 * 1024; // 30MB
            $this->assertLessThan($expectedMaxMemoryUsage, memory_get_peak_usage(true), 'Entities should not be expanded and therefore consume all the memory.');
        }
    }

    /**
     * @return void
     */
    public function testReadShouldBeAbleToProcessEmptySheets()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_no_cells.xlsx');
        $this->assertEquals([], $allRows, 'Sheet with no cells should be correctly processed.');
    }

    /**
     * @return void
     */
    public function testReadShouldSkipFormulas()
    {
        $allRows = $this->getAllRowsForFile('sheet_with_formulas.xlsx');

        $expectedRows = [
            ['val1', 'val2', 'total1', 'total2'],
            [10, 20, 30, 21],
            [11, 21, 32, 41],
        ];
        $this->assertEquals($expectedRows, $allRows);
    }

    /**
     * @param string $fileName
     * @return array All the read rows the given file
     */
    private function getAllRowsForFile($fileName)
    {
        $allRows = [];
        $resourcePath = $this->getResourcePath($fileName);

        $reader = ReaderFactory::create(Type::XLSX);
        $reader->open($resourcePath);

        while ($reader->hasNextSheet()) {
            $reader->nextSheet();

            while ($reader->hasNextRow()) {
                $allRows[] = $reader->nextRow();
            }
        }

        $reader->close();

        return $allRows;
    }
}
