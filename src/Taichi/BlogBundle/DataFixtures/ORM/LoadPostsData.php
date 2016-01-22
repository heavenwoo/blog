<?php
namespace Taichi\BlogBundle\DataFixtures\ORM;

ini_set('memory_limit', -1);

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Faker\Factory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Taichi\BlogBundle\Entity\Post;
use Taichi\BlogBundle\Entity\Comment;

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

    const POST_NUMS = 2000;

    const COMMENT_NUMS = 50;

    public function load(ObjectManager $manager)
    {
        $user = $manager
            ->getRepository('TaichiUserBundle:User')
            ->findOneBy(['username' => 'heaven']);

        foreach (range(1, self::POST_NUMS) as $i) {
            $post = new Post();

            $categories = $manager
                ->getRepository('TaichiBlogBundle:Category')
                ->findAll();

            $categoryIds = [];
            foreach ($categories as $category) {
                $categoryIds[] = $category->getId();
            }

            $cIdKey = array_rand($categoryIds, 1);

            $category = $manager
                ->getRepository('TaichiBlogBundle:Category')
                ->find($categoryIds[$cIdKey]);

            $post->setSubject(implode(' ', array_map('ucfirst', $this->faker->words(mt_rand(3, 5)))));
            $post->setAbstract($this->faker->paragraph(mt_rand(2, 4)));
            $post->setContent($this->faker->paragraph(mt_rand(6, 10)));
            $post->setUser($user);
            $post->setCategory($category);

            //Add tags
            $tags = $manager
                ->getRepository('TaichiBlogBundle:Tag')
                ->findAll();

            $tagIds = [];
            foreach ($tags as $tag) {
                $tagIds[] = $tag->getId();
            }

            $tIdKeys = array_rand($tagIds, mt_rand(2, 5));

            foreach ($tIdKeys as $tIdKey) {
                $tag = $manager
                    ->getRepository('TaichiBlogBundle:Tag')
                    ->find($tagIds[$tIdKey]);

                $post->addTag($tag);
            }

            $post->setPictureUrl($this->faker->imageUrl(400, 240));
            $post->setCreatedAt($this->faker->dateTimeBetween('-1 year', '-10 days'));
            $post->setUpdatedAt($post->getCreatedAt());

            foreach (range(1, mt_rand(1, self::COMMENT_NUMS)) as $j) {
                $comment = new Comment();

                $comment->setUser($user);
                $comment->setCreatedAt($this->faker->dateTimeBetween($post->getCreatedAt(), 'now'));
                $comment->setUpdatedAt($comment->getCreatedAt());
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