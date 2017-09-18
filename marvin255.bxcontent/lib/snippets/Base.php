<?php

namespace marvin255\bxcontent\snippets;

use marvin255\bxcontent\SnippetInterface;
use marvin255\bxcontent\ControlInterface;
use marvin255\bxcontent\SettingsTrait;
use marvin255\bxcontent\Exception;

/**
 * Базовый сниппет, получает данные из массива в конструкторе
 * и проверяет их на валидность.
 */
class Base implements SnippetInterface
{
    use SettingsTrait;

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->getSetting('type');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getSetting('label');
    }

    /**
     * @inheritdoc
     */
    public function getControls()
    {
        return $this->getSetting('controls');
    }

    /**
     * @inheritdoc
     */
    public function getRenderer()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function check(array $settings)
    {
        if (empty($settings['type']) || trim($settings['type']) === '') {
            throw new Exception('Snippet\'s type can\'t be empty');
        }

        if (empty($settings['label']) || trim($settings['label']) === '') {
            throw new Exception('Snippet\'s label can\'t be empty');
        }

        if (empty($settings['controls']) || !is_array($settings['controls'])) {
            throw new Exception('Snippet\'s controls must be a non empty array instance');
        } else {
            $controls = [];
            foreach ($settings['controls'] as $key => $control) {
                if (!($control instanceof ControlInterface)) {
                    throw new Exception("Control with key {$key} must be a ControlInterface instance");
                } elseif (isset($controls[$control->getName()])) {
                    throw new Exception('Control with name ' . $control->getName() . ' already exists');
                }
                $controls[$control->getName()] = $control;
            }
            $settings['controls'] = $controls;
        }

        return $settings;
    }
}
