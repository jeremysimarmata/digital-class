<?php
declare(strict_types=1);
namespace Kampus;

use InvalidArgumentException;

final class KrsService
{
    public function __construct(
        private readonly CourseCatalog $catalog = new CourseCatalog(),
        private readonly int $maximumCredits = 24
    ) {}

    /** @param string[] $courseCodes
     *  @return array{courses: array, totalCredits: int}
     */
    public function register(array $courseCodes): array
    {
        if ($courseCodes === []) {
            throw new InvalidArgumentException('Pilih minimal satu mata kuliah.');
        }

        $available = $this->catalog->all();
        $selected = [];
        $total = 0;

        foreach (array_unique($courseCodes) as $code) {
            if (!isset($available[$code])) {
                throw new InvalidArgumentException("Mata kuliah tidak ditemukan: {$code}");
            }
            $course = $available[$code];
            $total += $course['credits'];
            $selected[] = [
                'code' => $code,
                'name' => $course['name'],
                'credits' => $course['credits']
            ];
        }

        if ($total > $this->maximumCredits) {
            throw new InvalidArgumentException(
                "Total SKS {$total} melebihi batas {$this->maximumCredits} SKS."
            );
        }

        return ['courses' => $selected, 'totalCredits' => $total];
    }
}
