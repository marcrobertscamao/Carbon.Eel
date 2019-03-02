<?php

namespace Carbon\Eel;

/*
 *  (c) 2017 punkt.de GmbH - Karlsruhe, Germany - http://punkt.de
 *  All rights reserved.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;

/**
 * @Flow\Proxy(false)
 */
class ArrayHelper implements ProtectedContextAwareInterface
{

    /**
     * Generates a BEM array
     *
     * @param string $block
     * @param string $element
     * @param string|array $modifiers
     * @return array
     */
    public function BEM($block = null, $element = null, $modifiers = []): array
    {
        if (!isset($block) || !is_string($block) || !$block) {
            return [];
        }
        $baseClass = $element ? "{$block}__{$element}" : "{$block}";
        $classes = [$baseClass];

        if (isset($modifiers)) {
            if (is_string($modifiers)) {
                $modifiers = [$modifiers];
            }
            if (is_array($modifiers)) {
                foreach ($modifiers as $key => $value) {
                    if (!$value) {
                        continue;
                    }
                    if (is_string($value)) {
                        $classes[] = "{$baseClass}--{$value}";
                    } else if (is_string($key)) {
                        $classes[] = "{$baseClass}--{$key}";
                    }
                }
            }
        }

        return $classes;
    }

    /**
     * Adds a key / value pair to an array
     *
     * @param array $array
     * @param string $key
     * @param $value
     * @return array
     */
    public function setKeyValue(array $array, string $key, $value): array
    {
        $array[$key] = $value;
        return $array;
    }

    /**
     * Sort an array by key
     *
     * @param array $array
     * @return array
     */
    public function ksort(array $array): array
    {
        \ksort($array, SORT_NATURAL | SORT_FLAG_CASE);
        return $array;
    }

    /**
     * PHPs array_filter
     *
     * @param array $array
     * @return array
     */
    public function filter(array $array): array
    {
        return array_filter($array);
    }

    /**
     * Return array values
     *
     * @param array $array
     * @return array
     */
    public function values(array $array): array
    {
        return array_values($array);
    }

    /**
     * Join the given array recursively
     * using the given separator string.
     *
     * @param array $array
     * @param string $separator
     * @return string
     */
    public function join(array $array, string $separator = ','): string
    {
        $result = '';

        foreach ($array as $item) {
            if (is_array($item)) {
                $result .= $this->join($item, $separator) . $separator;
            } else {
                $result .= $item . $separator;
            }
        }

        $result = substr($result, 0, 0 - strlen($separator));

        return $result;
    }

    /**
     * This method extracts sub elements to the parent level.
     *
     * An input array of type:
     * [
     *  element1 => [
     *    0 => 'value1'
     *  ],
     *  element2 => [
     *    0 => 'value2'
     *    1 => 'value3'
     *  ],
     *
     * will be converted to:
     * [
     *    0 => 'value1'
     *    1 => 'value2'
     *    2 => 'value3'
     * ]
     *
     * @param array $array
     * @param bool $preserveKeys
     * @return array
     */
    public function extractSubElements(array $array, bool $preserveKeys = false): array
    {
        $resultArray = [];

        foreach ($array as $element) {
            if (is_array($element)) {
                foreach ($element as $subKey => $subElement) {
                    if ($preserveKeys) {
                        $resultArray[$subKey] = $subElement;
                    } else {
                        $resultArray[] = $subElement;
                    }
                }
            } else {
                $resultArray[] = $element;
            }
        }

        return $resultArray;
    }

    /**
     * Removes duplicate values from an array
     *
     * @param array $array
     * @param bool $filter
     * @return array
     */
    public function unique(array $array, bool $filter = false): array
    {
        if ($filter) {
            $array = array_filter($array);
        }
        return array_unique($array);
    }

    /**
     * @param string $methodName
     * @return bool
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
