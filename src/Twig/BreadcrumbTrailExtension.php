<?php

/*
 * This file is part of the APYBreadcrumbTrailBundle.
 *
 * (c) Abhoryo <abhoryo@free.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APY\BreadcrumbTrailBundle\Twig;

use APY\BreadcrumbTrailBundle\BreadcrumbTrail\Trail;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Provides an extension for Twig to output breadcrumbs.
 */
class BreadcrumbTrailExtension extends AbstractExtension
{
    private $trail;
    private $templating;

    /**
     * BreadcrumbTrailExtension constructor.
     */
    public function __construct(Trail $trail, Environment $templating)
    {
        $this->trail = $trail;
        $this->templating = $templating;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('apy_breadcrumb_trail_render', [$this, 'renderBreadcrumbTrail'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Renders the breadcrumb trail in a list.
     *
     * @return string
     */
    public function renderBreadcrumbTrail($template = null)
    {
        return $this->templating->render(
                null === $template ? $this->trail->getTemplate() : $template,
                ['breadcrumbs' => $this->trail]
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'breadcrumbtrail';
    }
}
