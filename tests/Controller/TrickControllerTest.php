<?php

namespace App\Test\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TrickRepository $repository;
    private string $path = '/tricks/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Trick::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('tricks index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'tricks[nameTrick]' => 'Testing',
            'tricks[description]' => 'Testing',
            'tricks[creationDate]' => 'Testing',
            'tricks[user]' => 'Testing',
            'tricks[groupTrick]' => 'Testing',
        ]);

        self::assertResponseRedirects('/tricks/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Trick();
        $fixture->setNameTrick('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setUser('My Title');
        $fixture->setGroupTrick('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('tricks');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Trick();
        $fixture->setNameTrick('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setUser('My Title');
        $fixture->setGroupTrick('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'tricks[nameTrick]' => 'Something New',
            'tricks[description]' => 'Something New',
            'tricks[creationDate]' => 'Something New',
            'tricks[user]' => 'Something New',
            'tricks[groupTrick]' => 'Something New',
        ]);

        self::assertResponseRedirects('/tricks/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNameTrick());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCreationDate());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getGroupTrick());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Trick();
        $fixture->setNameTrick('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCreationDate('My Title');
        $fixture->setUser('My Title');
        $fixture->setGroupTrick('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/tricks/');
    }
}
