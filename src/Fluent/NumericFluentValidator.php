<?php


namespace Dusan\PhpMvc\Validation\Fluent;


class NumericFluentValidator extends BaseFluentValidator
{

    protected $type = NULL;

    /**
     *
     * @param        $start
     * @param        $end
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function between($start, $end, string $message = 'Number must be between %d and %d'): NumericFluentValidator
    {
        $this->validations->push('between', function ($value) use ($start, $end, $message) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }
            if ($value > $start && $value < $end) {
                return NULL;
            }
            return sprintf($message, $start, $end);
        });
        return $this;
    }

    public function betweenIncluding($start, $end, string $message = 'Number must be between %d and %d'): NumericFluentValidator
    {
        $this->validations->push('between', function ($value) use ($start, $end, $message) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }
            if ($value >= $start && $value <= $end) {
                return NULL;
            }
            return sprintf($message, $start, $end);
        });
        return $this;
    }

    /**
     * @param        $min
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function min($min, string $message = 'Number must be minimum %d'): NumericFluentValidator
    {
        $this->validations->push('min', function ($value) use ($message, $min) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }

            if ($value > $min) return NULL;
            return sprintf($message, $min);
        });
        return $this;
    }

    /**
     * @param        $min
     * @param string $message
     *
     * @return NumericFluentValidator
     */
    public function minIncluding($min, string $message = 'Number must be minimum %d'): NumericFluentValidator
    {
        $this->validations->push('min', function ($value) use ($message, $min) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }

            if ($value >= $min) return NULL;
            return sprintf($message, $min);
        });
        return $this;
    }

    /**
     * @param        $max
     * @param string $message
     *
     * @return NumericFluentValidator
     */
    public function max($max, string $message = 'Number must not exceed %d'): NumericFluentValidator
    {
        $this->validations->push('max', function ($value) use ($message, $max) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }
            if ($value < $max) return NULL;
            return sprintf($message, $max);
        });
        return $this;
    }

    /**
     * @param        $max
     * @param string $message
     *
     * @return NumericFluentValidator
     */
    public function maxIncluding($max, string $message = 'Number must not exceed %d'): NumericFluentValidator
    {
        $this->validations->push('max', function ($value) use ($message, $max) {
            if ($this->type) {
                if (!settype($value, $this->type)) return 'Type could not be converted';
            }
            if ($value <= $max) return NULL;
            return sprintf($message, $max);
        });
        return $this;
    }
}
