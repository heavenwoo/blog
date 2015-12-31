<?php
namespace Taichi\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Comment;
use Carbon\Carbon;

class LoadPostsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /** @var \Faker\Generator */
    protected $faker;

    /** @var ContainerInterface  */
    protected $container;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $user = $manager
            ->getRepository('TaichiBlogBundle:User')
            ->findOneBy(['username' => 'heaven']);

        foreach (range(1, 30) as $i) {
            $post = new Post();

            $category = $manager
                ->getRepository('TaichiBlogBundle:Category')
                ->findOneBy(['id' => mt_rand(1, 6)]);

            $post->setSubject(implode(' ', array_map('ucfirst', $this->faker->words(mt_rand(3, 5)))));
            $post->setSummary($this->faker->paragraph(mt_rand(2, 4)));
            $post->setContent($this->faker->paragraph(mt_rand(6, 10)));
            $post->setUser($user);
            $post->setCategory($category);
//            foreach (range(1, mt_rand(2, 5)) as $k) {
//                $tag = $manager
//                    ->getRepository('TaichiBlogBundle:Tag')
//                    ->findOneBy(['id' => mt_rand(1, 10)]);
//
//                $tag->addPost($post);
//                $post->addTag($tag);
//            }
            $post->setPictureUrl($this->faker->imageUrl(400, 240));
            $post->setCreatedAt(new Carbon($this->faker->dateTimeBetween('-1 year', '-10 days')->format("Y-m-d H:i:s")));
            $post->setUpdatedAt(new Carbon($post->getCreatedAt()->format("Y-m-d H:i:s")));

            foreach (range(1, 5) as $j) {
                $comment = new Comment();

                $comment->setUser($user);
                $comment->setCreatedAt(new Carbon($this->faker->dateTimeBetween($post->getCreatedAt(), 'now')->format("Y-m-d H:i:s")));
                $comment->setUpdatedAt(new Carbon($comment->getCreatedAt()->format("Y-m-d H:i:s")));
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
        return 2;
    }
}