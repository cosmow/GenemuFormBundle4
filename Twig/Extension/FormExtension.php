<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Genemu\Bundle\FormBundle\Twig\Extension;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * FormExtension extends Twig with form capabilities.
 *
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
class FormExtension extends AbstractExtension
{
    public $renderer;

    /**
     * Constructs.
     *
     * @param FormRenderer $renderer
     */
    public function __construct(FormRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('form_javascript', array($this, 'renderJavascript'), array('is_safe' => array('html'))),
            new TwigFunction('form_stylesheet', null, array(
                'is_safe' => array('html'),
                'node_class' => 'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode',
            )),
        );
    }

    /**
     * Render Function Form Javascript
     *
     * @param FormView $view
     * @param bool     $prototype
     *
     * @return string
     */
    public function renderJavascript(FormView $view, $prototype = false)
    {
        $block = $prototype ? 'javascript_prototype' : 'javascript';

        return $this->renderer->searchAndRenderBlock($view, $block);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'genemu.twig.extension.form';
    }
}
