<?php
/**
 * Note fixtures.
 */
namespace App\DataFixtures;

use App\Entity\Note;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class NoteFixtures.
 */
class NoteFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        $this->createMany(100, 'notes', function (int $i) {
            $note = new Note();
            $note->setTitle($this->faker->sentence);
            $note->setCreatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $note->setUpdatedAt(
                DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $note->setContent($this->faker->realText);

            return $note;
        });
        $this->manager->flush();
    }
}
