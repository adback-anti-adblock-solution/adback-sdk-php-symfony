<?php

namespace Adback\ApiClientBundle\Twig;

use Adback\ApiClientBundle\Generator\GlobalGenerator;

/**
 * Class ScriptExtension
 */
class ScriptExtension extends \Twig_Extension
{
    protected $globalGenerator;

    /**
     * @param GlobalGenerator $globalGenerator
     */
    public function __construct(GlobalGenerator $globalGenerator)
    {
        $this->globalGenerator = $globalGenerator;
    }

    /**
     * @return string
     */
    public function generateScripts()
    {
        return $this->globalGenerator->generate();
    }

    /**
     * @return string
     */
    public function generateAutopromoBannerScript()
    {
        return '';
    }

    /**
     * @return string
     */
    public function generateIabBannerScript()
    {
        return '';
    }

    /**
     * @return string
     */
    public function generateProductScript()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('adback_generate_scripts', [$this, 'generateScripts'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_autopromo_banner_script', [$this, 'generateAutopromoBannerScript'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_iab_banner_script', [$this, 'generateIabBannerScript'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('adback_generate_product_script', [$this, 'generateProductScript'], ['is_safe' => ['html']]),
        ];
    }
}
