<?php


namespace Dusan\PhpMvc\Validation\Fluent;


class FloatFluentValidator extends NumericFluentValidator
{
    protected $type = 'float';

    /**
     * @param float  $min
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function min(float $min, string $message = 'Number must be minimum %lf'): NumericFluentValidator
    {
        return parent::min($min, $message);
    }

    /**
     * @param float  $max
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function max(float $max, string $message = 'Number must not exceed %lf'): NumericFluentValidator
    {
        return parent::max($max, $message);
    }

    /**
     * @param float  $start
     * @param float  $end
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function between(float $start, float $end, string $message = 'Number must be between %lf and %lf')
        : NumericFluentValidator
    {
        return parent::between($start, $end, $message);
    }

    /**
     * @param float  $start
     * @param float  $end
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function betweenIncluding(float $start, float $end, string $message = 'Number must be between %lf and %lf')
        : NumericFluentValidator
    {
        return parent::betweenIncluding($start, $end, $message);
    }

    /**
     * @param float  $min
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function minIncluding(float $min, string $message = 'Number must be minimum %lf')
        : NumericFluentValidator
    {
        return parent::minIncluding($min, $message);
    }

    /**
     * @param float  $max
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function maxIncluding(float $max, string $message = 'Number must not exceed %lf')
        : NumericFluentValidator
    {
        return parent::maxIncluding($max, $message);
    }


}
