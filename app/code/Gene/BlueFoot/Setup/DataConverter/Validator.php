<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gene\BlueFoot\Setup\DataConverter;

use Magento\Framework\Serialize\Serializer\Json;

class Validator
{
    /**
     * @var Json
     */
    private $serializer;

    /**
     * Constructor
     *
     * @param Json $serializer
     */
    public function __construct(
        Json $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * Check if a JSON string is a valid BlueFoot content
     *
     * @param string $json
     * @param bool $isStage if we require an entire stage we will validate the first child is a row
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function isValidBlueFootJson($json, $isStage = true)
    {
        try {
            $structure = $this->serializer->unserialize($json);

            // Determine if the object has items with a key of type or contentType
            $valid = count($structure) > 0
                && (isset($structure['type']) || isset($structure['contentType']));

            // If we're validating an entire stage verify the first item is of type row
            if ($valid && $isStage && isset($structure['type'])) {
                return $structure['type'] === 'row';
            }

            return $valid;
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }
}
