<?php

namespace Doctrine\Tests\DBAL;

use Doctrine\DBAL\Driver\OCI8\Statement;
use Doctrine\Tests\DbalTestCase;

<<<<<<< HEAD:tests/Doctrine/Tests/DBAL/UtilTest.php
class UtilTest extends DbalTestCase
{
=======
use Doctrine\DBAL\Driver\OCI8\ConvertPositionalToNamedPlaceholders;
use Doctrine\DBAL\SQL\Parser;
use PHPUnit\Framework\TestCase;

class ConvertPositionalToNamedPlaceholdersTest extends TestCase
{
    /**
     * @param mixed[] $expectedOutputParamsMap
     *
     * @dataProvider positionalToNamedPlaceholdersProvider
     */
    public function testConvertPositionalToNamedParameters(
        string $inputSQL,
        string $expectedOutputSQL,
        array $expectedOutputParamsMap
    ): void {
        $parser  = new Parser(false);
        $visitor = new ConvertPositionalToNamedPlaceholders();

        $parser->parse($inputSQL, $visitor);

        self::assertEquals($expectedOutputSQL, $visitor->getSQL());
        self::assertEquals($expectedOutputParamsMap, $visitor->getParameterMap());
    }

>>>>>>> 4fbd7accf (Port SQL parser from PDO):tests/Driver/OCI8/ConvertPositionalToNamedPlaceholdersTest.php
    /**
     * @return mixed[][]
     */
    public static function dataConvertPositionalToNamedParameters(): iterable
    {
        return [
            [
                'SELECT name FROM users WHERE id = ?',
                'SELECT name FROM users WHERE id = :param1',
                [1 => ':param1'],
            ],
            [
                'SELECT name FROM users WHERE id = ? AND status = ?',
                'SELECT name FROM users WHERE id = :param1 AND status = :param2',
                [1 => ':param1', 2 => ':param2'],
            ],
            [
                "UPDATE users SET name = '???', status = ?",
                "UPDATE users SET name = '???', status = :param1",
                [1 => ':param1'],
            ],
            [
                "UPDATE users SET status = ?, name = '???'",
                "UPDATE users SET status = :param1, name = '???'",
                [1 => ':param1'],
            ],
            [
                "UPDATE users SET foo = ?, name = '???', status = ?",
                "UPDATE users SET foo = :param1, name = '???', status = :param2",
                [1 => ':param1', 2 => ':param2'],
            ],
            [
                'UPDATE users SET name = "???", status = ?',
                'UPDATE users SET name = "???", status = :param1',
                [1 => ':param1'],
            ],
            [
                'UPDATE users SET status = ?, name = "???"',
                'UPDATE users SET status = :param1, name = "???"',
                [1 => ':param1'],
            ],
            [
                'UPDATE users SET foo = ?, name = "???", status = ?',
                'UPDATE users SET foo = :param1, name = "???", status = :param2',
                [1 => ':param1', 2 => ':param2'],
            ],
            [
                'SELECT * FROM users WHERE id = ? AND name = "" AND status = ?',
                'SELECT * FROM users WHERE id = :param1 AND name = "" AND status = :param2',
                [1 => ':param1', 2 => ':param2'],
            ],
            [
                "SELECT * FROM users WHERE id = ? AND name = '' AND status = ?",
                "SELECT * FROM users WHERE id = :param1 AND name = '' AND status = :param2",
                [1 => ':param1', 2 => ':param2'],
            ],
        ];
    }
<<<<<<< HEAD:tests/Doctrine/Tests/DBAL/UtilTest.php

    /**
     * @param mixed[] $expectedOutputParamsMap
     *
     * @dataProvider dataConvertPositionalToNamedParameters
     */
    public function testConvertPositionalToNamedParameters(
        string $inputSQL,
        string $expectedOutputSQL,
        array $expectedOutputParamsMap
    ): void {
        [$statement, $params] = Statement::convertPositionalToNamedPlaceholders($inputSQL);

        self::assertEquals($expectedOutputSQL, $statement);
        self::assertEquals($expectedOutputParamsMap, $params);
    }
=======
>>>>>>> 4fbd7accf (Port SQL parser from PDO):tests/Driver/OCI8/ConvertPositionalToNamedPlaceholdersTest.php
}
