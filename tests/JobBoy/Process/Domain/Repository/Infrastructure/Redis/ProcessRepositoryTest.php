<?php

namespace Tests\JobBoy\Process\Domain\Repository\Infrastructure\Redis;

use JobBoy\Process\Domain\Entity\Factory\ProcessFactory;
use JobBoy\Process\Domain\Entity\Infrastructure\TouchCallback\Process;
use JobBoy\Process\Domain\Repository\Infrastructure\Redis\ProcessRepository;
use JobBoy\Process\Domain\Repository\Infrastructure\Redis\RedisFactory;
use JobBoy\Process\Domain\Repository\ProcessRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Tests\JobBoy\Process\Domain\Repository\ProcessRepositoryInterfaceTest;
use Tests\JobBoy\Test\Util\FsUtil;

class ProcessRepositoryTest extends ProcessRepositoryInterfaceTest
{

    /**
     * @test
     */
    public function class_ProcessRepositoryInterfaceTest_is_correct()
    {
        $this->assertFileEquals(
            __DIR__.'/../../ProcessRepositoryInterfaceTest.php',
            FsUtil::projectDir().'/vendor/dansan/jobboy/tests/JobBoy/Process/Domain/Repository/ProcessRepositoryInterfaceTest.php'
        );
    }

    protected function createRepository(): ProcessRepositoryInterface
    {
        $redisFactory = new RedisFactory('redis');
        $redis = $redisFactory->create();

        $id = Uuid::uuid4();

        return new ProcessRepository($redis, 'test.jobboy.processes.' . $id);
    }

    protected function createFactory(): ProcessFactory
    {
        return new ProcessFactory(Process::class);
    }
}
