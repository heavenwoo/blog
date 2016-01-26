<?php
namespace Taichi\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Taichi\BlogBundle\Entity\Category;
use Taichi\BlogBundle\Entity\Tag;
use Taichi\UserBundle\Entity\User;


class LoadData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /** @var \Faker\Generator */
    protected $faker;

    /** @var ContainerInterface  */
    protected $container;

    const TAG_NUMS = 10;

    const CATEGORY_NUMS = 6;

    const USER_NUMS = 5;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadTags($manager);
        $this->loadUsers($manager);
        $this->loadCategories($manager);
    }

    protected function loadTags(ObjectManager $manager)
    {
        for ($i = 0; $i < self::TAG_NUMS; $i++) {
            $tag = new Tag();
            $tag->setName($this->faker->word);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    protected function loadUsers(ObjectManager $manager)
    {
        $manager->persist($this->setUser('heaven', 'heaven', 'heavenwoo@live.com', true));

        foreach (range(1, self::USER_NUMS) as $i) {
            $manager->persist($this->setUser());
        }

        $manager->flush();
    }

    private function setUser($username = '', $password = '', $email = '', $supperAdmin = false)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setUsername($username ?: $this->faker->name);
        $user->setUsernameCanonical($username ?: $user->getUsername());
        $user->setEmail($email ?: $this->faker->email);
        $user->setEmailCanonical($email ?: $user->getEmail());
        $user->setEnabled($supperAdmin ? true : (bool)mt_rand(0, 1));
        $user->setSuperAdmin((bool) $supperAdmin);
        $encodedPassword = $passwordEncoder->encodePassword($user, $password ?: $user->getUsername());
        $user->setPassword($encodedPassword);
        $user->setCreatedAt($this->faker->dateTimeBetween('-1 year', '-10 days'));

        return $user;
    }

    protected function loadCategories(ObjectManager $manager)
    {
        foreach (range(1, self::CATEGORY_NUMS) as $i) {
            $category = new Category();

            $category->setName($this->faker->citySuffix);

            $manager->persist($category);
        }

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder()
    {
        return 1;
    }
}