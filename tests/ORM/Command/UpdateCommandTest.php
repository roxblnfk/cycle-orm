<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\ORM\Tests\Command;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Spiral\Database\DatabaseInterface;
use Spiral\ORM\Command\Database\UpdateCommand;

class UpdateCommandTest extends TestCase
{
    public function testIsEmpty()
    {
        $cmd = new UpdateCommand(
            m::mock(DatabaseInterface::class),
            'table',
            [],
            []
        );

        $this->assertTrue($cmd->isEmpty());
    }

    public function testIsEmptyData()
    {
        $cmd = new UpdateCommand(
            m::mock(DatabaseInterface::class),
            'table',
            ['name' => 'value'],
            ['where' => 'value']
        );

        $this->assertFalse($cmd->isEmpty());
        $this->assertSame(['name' => 'value'], $cmd->getData());
    }

    public function testIsEmptyContext()
    {
        $cmd = new UpdateCommand(
            m::mock(DatabaseInterface::class),
            'table',
            ['name' => 'value'],
            ['where' => 'value']
        );

        $this->assertFalse($cmd->isEmpty());

        $cmd->setContext('key', 'value');
        $this->assertSame(['key' => 'value'], $cmd->getContext());
    }

    public function testWhere()
    {
        $cmd = new UpdateCommand(
            m::mock(DatabaseInterface::class),
            'table',
            ['name' => 'value'],
            []
        );

        $cmd->setWhere('key', 'value');
        $this->assertSame(['key' => 'value'], $cmd->getWhere());
    }

    /**
     * @expectedException \Spiral\ORM\Exception\CommandException
     */
    public function testNoScope()
    {
        $cmd = new UpdateCommand(
            m::mock(DatabaseInterface::class),
            'table',
            ['name' => 'value'],
            []
        );

        $cmd->execute();
    }
}