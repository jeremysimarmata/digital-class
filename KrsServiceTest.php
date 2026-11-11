<?php
declare(strict_types=1);
namespace Kampus\Tests;

use Kampus\KrsService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class KrsServiceTest extends TestCase
{
    public function testRegistersValidCourses(): void
    {
        $result = (new KrsService())->register(['IF201', 'IF202']);
        self::assertCount(2, $result['courses']);
        self::assertSame(6, $result['totalCredits']);
    }

    public function testRejectsEmptySelection(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Pilih minimal satu mata kuliah.');
        (new KrsService())->register([]);
    }

    public function testRejectsUnknownCourse(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new KrsService())->register(['XX999']);
    }

    public function testRejectsMoreThanMaximumCredits(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new KrsService())->register(['IF201','IF202','IF203','IF204','IF205','IF206','IF207','IF208','IF201']);
    }

    public function testDoesNotCountDuplicateTwice(): void
    {
        $result = (new KrsService())->register(['IF201', 'IF201']);
        self::assertCount(1, $result['courses']);
        self::assertSame(3, $result['totalCredits']);
    }
}
