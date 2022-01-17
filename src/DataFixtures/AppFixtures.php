<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $slugger = new AsciiSlugger();
        for($i=0; $i<20; $i++){
            $post = new Post();
            $post->setTitle("Post " . $i);
            //$post->setUrlAlias($slugger->slug($post->getTitle()));
            $post->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel mi sit amet risus vestibulum facilisis vel quis augue. Quisque hendrerit semper ligula in lacinia. Mauris volutpat hendrerit sapien, vulputate efficitur metus. Aenean consequat diam urna, in finibus tellus placerat vitae. Donec vitae mi et nibh ultrices venenatis. Donec pretium pellentesque eros varius egestas. Aenean hendrerit tortor orci, non sollicitudin lacus elementum sit amet. Integer ac massa fringilla, convallis ligula a, sodales magna. Aliquam sollicitudin tincidunt scelerisque. Mauris quis quam tincidunt, pulvinar arcu et, fermentum diam. Nulla fermentum aliquam finibus. Etiam sed dolor venenatis, vehicula massa eget, venenatis ipsum. Nam velit lacus, pulvinar id velit sed, tempor lacinia risus. Aliquam eget leo sit amet odio vestibulum lacinia. Mauris feugiat mauris vitae volutpat rhoncus.

            In ultricies feugiat sodales. Sed fringilla ultrices justo, id rutrum sem ultrices et. In efficitur at libero sed aliquam. Sed vitae commodo urna, rutrum commodo enim. Sed tristique volutpat ullamcorper. Phasellus sagittis tortor a metus placerat congue sit amet ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus in laoreet orci, id varius enim. Ut cursus mi diam, luctus aliquet turpis ultrices feugiat. Pellentesque eu gravida sem, sed placerat turpis. Duis imperdiet commodo sapien, ut semper massa feugiat consequat.
            
            Sed cursus egestas nisi, ac accumsan est aliquam non. Nulla facilisi. Cras cursus rhoncus luctus. Nunc laoreet, odio a dignissim ultricies, mi mauris cursus nisl, vel lobortis ex massa nec sem. Nulla id tincidunt diam. Donec id mi felis. Morbi quis facilisis elit. Morbi consequat elit elit, eu pharetra mi volutpat at. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae nisl id nunc euismod tincidunt et sit amet lorem. Donec rhoncus ullamcorper mattis. Mauris euismod leo vel ex egestas imperdiet.
            
            Duis maximus magna orci, eget maximus elit porta non. Ut vel ex tortor. Quisque non aliquet nisi. Suspendisse imperdiet dignissim eros. Etiam eget condimentum velit, vel tempus diam. Pellentesque efficitur neque suscipit nisi tempor, eu euismod nunc varius. Aenean non ipsum convallis, porta sapien vitae, efficitur neque. Morbi id lacus consectetur, feugiat lacus quis, mattis nibh. Curabitur eu velit eu quam interdum ullamcorper luctus sit amet orci. Aenean varius est eu urna consectetur rhoncus. In faucibus quis nibh a euismod. Donec hendrerit turpis ut blandit feugiat. Ut et luctus elit. Suspendisse euismod dui a massa semper, non consequat magna facilisis.
            
            Vivamus a ipsum eget massa sagittis facilisis eu quis quam. In commodo vitae dui congue maximus. Sed et posuere odio. Praesent imperdiet at nisi ut auctor. Quisque bibendum posuere molestie. In elit purus, egestas in purus a, mollis pharetra nulla. Praesent gravida semper massa sed iaculis. Phasellus eget est odio. Maecenas a felis pharetra mi laoreet posuere nec et ipsum. Praesent libero ante, elementum ut porta sed, lobortis quis nisl. Aenean in ex eget odio commodo dapibus vel lacinia dui. Ut ipsum tellus, hendrerit eget nibh ac, posuere ultricies odio. Maecenas cursus nisi a nulla iaculis congue. Pellentesque vitae dictum nibh.");
            $post->setPublished((new \DateTime())->sub(new DateInterval('P'.$i.'D')));
            $post->setIllustration("");
            $manager->persist($post);
        }

        $manager->flush();
    }
}
