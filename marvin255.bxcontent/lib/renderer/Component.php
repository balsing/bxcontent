<?php

namespace marvin255\bxcontent\renderer;

use CMain;
use marvin255\bxcontent\snippet\SnippetInterface;

/**
 * Объект, который вызывает компонент Битрикса для того, чтобы отобразить сниппет.
 */
class Component implements RendererInterface
{
    /**
     * Ссылка на объект приложения Битрикса.
     *
     * @var \CMain
     */
    protected $app = null;
    /**
     * Строка с названием компонента для отображения.
     *
     * @var string
     */
    protected $component = '';
    /**
     * Строка с названием шаблона компонента для отображения.
     *
     * @var string
     */
    protected $template = null;

    /**
     * Конструктор.
     *
     * @param CMain  $app       Ссылка на объект приложения Битрикса
     * @param string $component Строка с названием компонента для отображения
     * @param string $template  Строка с названием шаблона компонента для отображения
     */
    public function __construct(CMain $app, $component, $template = '')
    {
        $this->app = $app;
        $this->component = $component;
        $this->template = $template;
    }

    /**
     * @inheritdoc
     */
    public function render(SnippetInterface $snippet)
    {
        ob_start();
        ob_implicit_flush(false);
        $this->app->includeComponent(
            $this->component,
            $this->template,
            $snippet->getValue(),
            ['HIDE_ICONS' => 'Y']
        );

        return ob_get_clean();
    }
}