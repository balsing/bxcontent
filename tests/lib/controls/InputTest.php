<?php

namespace marvin255\bxcontent\tests\lib\snippets;

class InputTest extends \PHPUnit_Framework_TestCase
{
    public function testGetType()
    {
        $arConfig = [
            'type' => 'type_' . mt_rand(),
            'label' => 'label_' . mt_rand(),
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];

        $input = new \marvin255\bxcontent\controls\Input($arConfig);

        $this->assertSame(
            'input',
            $input->getType()
        );
    }

    public function testGetName()
    {
        $arConfig = [
            'type' => 'input',
            'label' => 'label_' . mt_rand(),
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];

        $input = new \marvin255\bxcontent\controls\Input($arConfig);

        $this->assertSame(
            $arConfig['name'],
            $input->getName()
        );
    }

    public function testGetLabel()
    {
        $arConfig = [
            'type' => 'input',
            'label' => 'label_' . mt_rand(),
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];

        $input = new \marvin255\bxcontent\controls\Input($arConfig);

        $this->assertSame(
            $arConfig['label'],
            $input->getLabel()
        );
    }

    public function testIsMultiple()
    {
        $arConfig = [
            'type' => 'input',
            'label' => 'label_' . mt_rand(),
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];

        $input = new \marvin255\bxcontent\controls\Input($arConfig);

        $this->assertSame(
            $arConfig['multiple'],
            $input->isMultiple()
        );
    }

    public function testJsonSerialize()
    {
        $arConfig = [
            'type' => 'input',
            'label' => 'label_' . mt_rand(),
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];
        ksort($arConfig);

        $input = new \marvin255\bxcontent\controls\Input($arConfig);

        $return = $input->jsonSerialize();
        ksort($return);
        $this->assertSame(
            $arConfig,
            $return
        );
    }

    public function testEmptyNameException()
    {
        $arConfig = [
            'type' => 'input',
            'label' => 'label_' . mt_rand(),
            'multiple' => true,
        ];

        $this->setExpectedException('\marvin255\bxcontent\Exception', 'name');
        $snippet = new \marvin255\bxcontent\controls\Input($arConfig);
    }

    public function testEmptyLabelException()
    {
        $arConfig = [
            'type' => 'input',
            'name' => 'name_' . mt_rand(),
            'multiple' => true,
        ];

        $this->setExpectedException('\marvin255\bxcontent\Exception', 'label');
        $snippet = new \marvin255\bxcontent\controls\Input($arConfig);
    }
}
