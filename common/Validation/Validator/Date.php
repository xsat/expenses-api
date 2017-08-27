<?php

namespace Common\Validation\Validator;

use DateTime;
use Nen\Validation\Validator\Validator;
use Nen\Validation\ValuesInterface;

/**
 * Class Date
 */
class Date extends Validator
{
    /**
     * @var string
     */
    private $format;

    /**
     * Date constructor.
     *
     * @param string $field
     * @param string $format
     * @param string $message
     */
    public function __construct(
        string $field,
        string $format,
        string $message
    )
    {
        parent::__construct($field, $message);

        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ValuesInterface $values): bool
    {
        $value = $values->getValue($this->getField());
        DateTime::createFromFormat($this->format, $value);
        $errors = DateTime::getLastErrors();

        return !$errors['warning_count'] && !$errors['error_count'];
    }
}
