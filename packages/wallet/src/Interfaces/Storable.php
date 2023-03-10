<?php

namespace Incevio\Package\Wallet\Interfaces;

interface Storable
{
    /**
     * Get balance from storage.
     *
     * @param Wallet $object
     * @return int|float
     */
    public function getBalance($object);

    /**
     * We increase the balance by the amount.
     *
     * @param Wallet $object
     * @param int $amount
     * @return int|float
     */
    public function incBalance($object, $amount);

    /**
     * We set the exact amount.
     *
     * @param Wallet $object
     * @param int $amount
     * @return bool
     */
    public function setBalance($object, $amount): bool;

    /**
     * We clean the storage, a need for consumers.
     * Expected in 6.x version.
     *
     * @return bool
     */
    // public function fresh(): bool;
}
