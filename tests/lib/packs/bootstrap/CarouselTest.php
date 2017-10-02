<?php

namespace marvin255\bxcontent\tests\lib\packs\bootstrap;

class CarouselTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultConfig()
    {
        $testLabel = 'label_' . mt_rand();

        $manager = \marvin255\bxcontent\SnippetManager::getInstance(true);
        \marvin255\bxcontent\packs\bootstrap\Carousel::setTo($manager, ['label' => $testLabel]);

        $this->assertInstanceOf(
            '\marvin255\bxcontent\packs\bootstrap\Carousel',
            $manager->get('bootstrap.carousel')
        );

        $this->assertSame(
            $testLabel,
            $manager->get('bootstrap.carousel')->getLabel()
        );
    }

    public function testRenderView()
    {
        $renderArray = ['key_' . mt_rand() => 'value_' . mt_rand()];

        $view = $this->getMockBuilder('\marvin255\bxcontent\views\ViewInterface')
            ->setMethods(['render'])
            ->getMock();
        $view->expects($this->once())
            ->method('render')
            ->with($this->equalTo($renderArray));

        $manager = \marvin255\bxcontent\SnippetManager::getInstance(true);
        \marvin255\bxcontent\packs\bootstrap\Carousel::setTo($manager, ['view' => $view]);
        $manager->get('bootstrap.carousel')->render($renderArray);
    }

    public function testRenderInternal()
    {
        $renderArray = [
            'items' => [
                0 => [
                    'image' => 'image_' . mt_rand(),
                    'caption' => 'caption_' . mt_rand(),
                    'text' => 'text_' . mt_rand(),
                    'link' => 'link_' . mt_rand(),
                ],
                1 => [
                    'image' => 'image_1_' . mt_rand(),
                    'text' => 'text_1_' . mt_rand(),
                ],
                2 => [
                    'text' => 'text_2_' . mt_rand(),
                    'caption' => 'caption_' . mt_rand(),
                ],
            ],
        ];

        $manager = \marvin255\bxcontent\SnippetManager::getInstance(true);
        \marvin255\bxcontent\packs\bootstrap\Carousel::setTo($manager);

        $rendered = $manager->get('bootstrap.carousel')->render($renderArray);

        $this->assertContains(
            $renderArray['items'][0]['image'],
            $rendered
        );
        $this->assertContains(
            $renderArray['items'][0]['caption'],
            $rendered
        );
        $this->assertContains(
            $renderArray['items'][0]['text'],
            $rendered
        );
        $this->assertContains(
            $renderArray['items'][0]['link'],
            $rendered
        );

        $this->assertContains(
            $renderArray['items'][1]['image'],
            $rendered
        );
        $this->assertContains(
            $renderArray['items'][1]['text'],
            $rendered
        );

        $this->assertNotContains(
            $renderArray['items'][2]['caption'],
            $rendered
        );
        $this->assertNotContains(
            $renderArray['items'][2]['text'],
            $rendered
        );
    }
}
