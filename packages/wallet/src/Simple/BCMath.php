<?php

namespace Incevio\Package\Wallet\Simple;

/**
 * Class BCMath.
 * @deprecated Will be removed in 6.x.
 */
class BCMath extends Math
{
    /**
     * {@inheritdoc}
     */
    public function add($first, $second, ?int $scale = null): string
    {
        return bcadd($first, $second, $this->scale($scale));
    }

    /**
     * {@inheritdoc}
     */
    public function sub($first, $second, ?int $scale = null): string
    {
        return bcsub($first, $second, $this->scale($scale));
    }

    /**
     * {@inheritdoc}
     */
    public function div($first, $second, ?int $scale = null): string
    {
        return bcdiv($first, $second, $this->scale($scale));
    }

    /**
     * {@inheritdoc}
     */
    public function mul($first, $second, ?int $scale = null): string
    {
        return bcmul($first, $second, $this->scale($scale));
    }

    /**
     * {@inheritdoc}
     */
    public function pow($first, $second, ?int $scale = null): string
    {
        return bcpow($first, $second, $this->scale($scale));
    }

    /**
     * {@inheritdoc}
     */
    public function ceil($number): string
    {
        if (strpos($number, '.') === false) {
            return $number;
        }

        if (preg_match("~\.[0]+$~", $number)) {
            return $this->round($number, 0);
        }

        if ($this->isNegative($number)) {
            return bcsub($number, 0, 0);
        }

        return bcadd($number, 1, 0);
    }

    /**
     * {@inheritdoc}
     */
    public function floor($number): string
    {
        if (strpos($number, '.') === false) {
            return $number;
        }

        if (preg_match("~\.[0]+$~", $number)) {
            return $this->round($number, 0);
        }

        if ($this->isNegative($number)) {
            return bcsub($number, 1, 0);
        }

        return bcadd($number, 0, 0);
    }

    /**
     * {@inheritdoc}
     */
    public function round($number, int $precision = Null): string
    {
        if (strpos($number, '.') === false) {
            return $number;
        }

        if ($precision == Null) {
            $precision = config('system_settings.decimals', 2);
        }

        if ($this->isNegative($number)) {
            return bcsub($number, '0.'.str_repeat('0', $precision).'5', $precision);
        }

        return bcadd($number, '0.'.str_repeat('0', $precision).'5', $precision);
    }

    /**
     * @param float|int|string $number
     * @return string
     */
    public function abs($number): string
    {
        if (! preg_match('~^-?\d*(\.\d*)?$~', $number, $matches)) {
            return 0;
        }

        $digits = $matches[0] ?? '0';
        $division = $matches[1] ?? '.';
        if ($digits === '.' && $division === '.') {
            return 0;
        }

        if ($this->isNegative($number)) {
            return substr($number, 1);
        }

        return $number;
    }

    /**
     * {@inheritdoc}
     */
    public function compare($first, $second): int
    {
        return bccomp($first, $second, $this->scale());
    }

    /**
     * @param $number
     * @return bool
     */
    protected function isNegative($number): bool
    {
        return strpos($number, '-') === 0;
    }
}
