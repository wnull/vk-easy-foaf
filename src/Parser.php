<?php

namespace VK\FOAF;

/**
 * Class Parser
 * @package VK\FOAF
 */
class Parser
{
    /**
     * @var string|bool $delimiter
     */
    protected string|bool $delimiter;

    /**
     * Parser constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->delimiter = $options['delimiter'] ?? '_';
    }

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
            '~jpg\K\?[^"]+~' => fn ($match) => join('|', explode('&', $match[0])),
            '~(?:ya|foaf|img|dc|rdf)\K:~' => fn ($match) => ''
        ], $get);

        $xml = simplexml_load_string($mutation);

        return $this->foafXMLtoArray($xml);
    }

    /**
     * @param \SimpleXMLElement|array $xml
     * @return array
     */
    private function foafXMLtoArray(\SimpleXMLElement|array $xml): array
    {
        $result = [];
        $xmlArray = (array) $xml;

        foreach ($xmlArray as $index => $node)
        {
            $postfix = $this->delimiter ? '$0' . $this->delimiter : '';
            $index = preg_replace(['/^(?:foaf|ya|@)/', '/^(?:rdf|dc|img)(?!$)/'], ['', $postfix], $index);

            $result[$index] = is_object($node) || is_array($node) ? $this->foafXMLtoArray($node) : str_replace('|', '&', $node) ;
        }

        return $result;
    }
}