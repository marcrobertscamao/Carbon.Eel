<?php

namespace Carbon\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Carbon\Eel\ArrayHelper;
use Carbon\Eel\StringHelper;

/**
 * @Flow\Proxy(false)
 */
class BemHelper implements ProtectedContextAwareInterface
{
    /**
     * Generates a BEM string
     *
     * @param string       $block     defaults to null
     * @param string       $element   defaults to null
     * @param string|array $modifiers defaults to []
     * 
     * @return string
     */
    public function string($block = null, $element = null, $modifiers = []): string
    {
        return (new StringHelper())->BEM($block, $element, $modifiers);
    }

    /**
     * Generates a BEM modifier string
     *
     * @param string       $class     defaults to null
     * @param string|array $modifiers defaults to []
     * 
     * @return array
     */
    public function modifier($class = null, $modifiers = []): string
    {
        return (new StringHelper())->BEM($class, null, $modifiers);
    }

    /**
     * Generates a BEM array
     *
     * @param string       $block     defaults to null
     * @param string       $element   defaults to null
     * @param string|array $modifiers defaults to []
     * 
     * @return array
     */
    public function array($block = null, $element = null, $modifiers = []): string
    {
        return (new ArrayHelper())->BEM($block, $element, $modifiers);
    }

    /**
     * All methods are considered safe
     * 
     * @param string $methodName The name of the method
     * 
     * @return bool
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}

