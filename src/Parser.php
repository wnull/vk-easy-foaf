<?php

namespace VKEasyFoaf;

/**
 * Class Parser
 * @package VKEasyFoaf
 */
class Parser
{
    /**
     * @param int $id
     * @return array
     */
    public function foaf(int $id): array
    {
        if ($id === 0) {
            throw new \LengthException('Invalid value, the ID cannot be null.');
        }

        $get = file_get_contents('https://vk.com/foaf.php?id=' . $id);

        $mutation = preg_replace_callback_array([
            '~&#?(?:\d+;?)|&~' => fn ($match) => htmlspecialchars($match[0]),
            '~(?:ya|foaf|img|dc|rdf):~' => fn () => ''
        ], $get);

        $xml = simplexml_load_string($mutation);

        return $this->foafXMLtoArray($xml);
    }

    /**
     * @param \SimpleXMLElement|array $xml
     * @return \SimpleXMLElement|array
     */
    private function foafXMLtoArray(\SimpleXMLElement|array $xml): \SimpleXMLElement|array
    {
        $result = [];
        $xmlArray = (array) $xml;

        foreach ($xmlArray as $index => $node) {
            if (str_starts_with($index, '@')) $index = ltrim($index, '@');
            $result[$index] = is_object($node) || is_array($node) ? $this->foafXMLtoArray($node) : $node;
        }

        return $result;
    }
}