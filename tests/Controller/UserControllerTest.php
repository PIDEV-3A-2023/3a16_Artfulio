<?php

namespace App\Test\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private UserRepository $repository;
    private string $path = '/user/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(User::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

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
            'user[username]' => 'Testing',
            'user[cin_user]' => 'Testing',
            'user[adresse_user]' => 'Testing',
            'user[password_user]' => 'Testing',
            'user[email_user]' => 'Testing',
            'user[is_pro]' => 'Testing',
            'user[img_user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/user/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setUsername('My Title');
        $fixture->setCin_user('My Title');
        $fixture->setAdresse_user('My Title');
        $fixture->setPassword_user('My Title');
        $fixture->setEmail_user('My Title');
        $fixture->setIs_pro('My Title');
        $fixture->setImg_user('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setUsername('My Title');
        $fixture->setCin_user('My Title');
        $fixture->setAdresse_user('My Title');
        $fixture->setPassword_user('My Title');
        $fixture->setEmail_user('My Title');
        $fixture->setIs_pro('My Title');
        $fixture->setImg_user('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[username]' => 'Something New',
            'user[cin_user]' => 'Something New',
            'user[adresse_user]' => 'Something New',
            'user[password_user]' => 'Something New',
            'user[email_user]' => 'Something New',
            'user[is_pro]' => 'Something New',
            'user[img_user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getCin_user());
        self::assertSame('Something New', $fixture[0]->getAdresse_user());
        self::assertSame('Something New', $fixture[0]->getPassword_user());
        self::assertSame('Something New', $fixture[0]->getEmail_user());
        self::assertSame('Something New', $fixture[0]->getIs_pro());
        self::assertSame('Something New', $fixture[0]->getImg_user());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new User();
        $fixture->setUsername('My Title');
        $fixture->setCin_user('My Title');
        $fixture->setAdresse_user('My Title');
        $fixture->setPassword_user('My Title');
        $fixture->setEmail_user('My Title');
        $fixture->setIs_pro('My Title');
        $fixture->setImg_user('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/user/');
    }
}
