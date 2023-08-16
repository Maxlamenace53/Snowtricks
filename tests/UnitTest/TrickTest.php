<?php

namespace App\Tests\UnitTest;

use App\Entity\Trick;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    public function testNameTrick(): void
    {
        $trick = new Trick();
        $trick->setNameTrick('name_test_trick');

        $this->assertSame('name_test_trick', $trick->getNameTrick());
    }


}
