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
use Taichi\BlogBundle\Entity\User;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Comment;


class LoadData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /** @var \Faker\Generator */
    protected $faker;

    /** @var ContainerInterface  */
    protected $container;

    protected $tags = 10;

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
        for ($i = 0; $i < $this->tags; $i++) {
            $tag = new Tag();
            $tag->setName($this->faker->word);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    protected function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $user = new User();
        $user->setUsername('john_user');
        $user->setEmail('john_user@symfony.com');
        $encodedPassword = $passwordEncoder->encodePassword($user, 'kitten');
        $user->setPassword($encodedPassword);
        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('heaven');
        $admin->setEmail('heavenwoo@live.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $encodedPassword = $passwordEncoder->encodePassword($admin, 'heaven');
        $admin->setPassword($encodedPassword);
        $manager->persist($admin);

        $manager->flush();
    }

    protected function loadCategories(ObjectManager $manager)
    {
        foreach (range(1, 6) as $i) {
            $category = new Category();

            $category->setName($this->faker->citySuffix);

            $manager->persist($category);
        }

        $manager->flush();
    }

    protected function loadPosts(ObjectManager $manager)
    {
        $user = $manager
            ->getRepository('TaichiBlogBundle:Post')
            ->findOneBy(['id' => 2]);

        foreach (range(1, 30) as $i) {
            $post = new Post();

            $category = $manager
                ->getRepository('TaichiBlogBundle:Category')
                ->findOneBy(['id' => mt_rand(1, 6)]);


            $post->setSubject($this->faker->title);
            $post->setSummary($this->faker->paragraph(mt_rand(2, 4)));
            $post->setContent($this->faker->paragraph(mt_rand(6, 10)));
            $post->setUser($user);
            $post->setCategory($category);
            for ($k = 0; $k < mt_rand(2, 5); $k++) {
                $tags = $manager
                    ->getRepository('TaichiBlogBundle:Post')
                    ->findOneBy(['id' => mt_rand(1, 10)]);

                $post->addTag($tags);
            }
            $post->setPictureUrl($this->faker->imageUrl(400, 240));
//            $post->setCreatedAt(new \DateTime('now - '.$i.'days'));
            $post->setCreatedAt($this->faker->dateTimeBetween('-20 days', 'now'));
            $post->setUpdatedAt(new \DateTime('now - '.$i.'days'));

            foreach (range(1, 5) as $j) {
                $comment = new Comment();

                $comment->setUser($user);
                $comment->setCreatedAt(new \DateTime('now + '.($i + $j).'seconds'));
                $comment->setUpdatedAt(new \DateTime('now + '.($i + $j).'seconds'));
                $comment->setContent($this->faker->paragraph(mt_rand(1, 3)));
                $comment->setPost($post);

                $manager->persist($comment);
                $post->addComment($comment);
            }

            $manager->persist($post);
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