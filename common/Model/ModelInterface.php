<?php

namespace Common\Model;

/**
 * Interface ModelInterface
 */
interface ModelInterface
{
    /**
     * @param array $state
     *
     * @return ModelInterface
     */
    public static function fromState(array $state): ModelInterface;
}
