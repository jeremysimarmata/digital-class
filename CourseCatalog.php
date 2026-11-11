<?php
declare(strict_types=1);
namespace Kampus;

final class CourseCatalog
{
    /** @return array<string, array{name:string, credits:int}> */
    public function all(): array
    {
        return [
            'IF201' => ['name' => 'Pemrograman Web', 'credits' => 3],
            'IF202' => ['name' => 'Basis Data', 'credits' => 3],
            'IF203' => ['name' => 'Jaringan Komputer', 'credits' => 3],
            'IF204' => ['name' => 'Rekayasa Perangkat Lunak', 'credits' => 3],
            'IF205' => ['name' => 'Sistem Operasi', 'credits' => 3],
            'IF206' => ['name' => 'Kecerdasan Buatan', 'credits' => 3],
            'IF207' => ['name' => 'Keamanan Informasi', 'credits' => 3],
            'IF208' => ['name' => 'Interaksi Manusia dan Komputer', 'credits' => 3],
        ];
    }
}
