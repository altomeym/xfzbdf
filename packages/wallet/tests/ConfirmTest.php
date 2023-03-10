<?php

namespace Incevio\Package\Wallet\Test;

use Incevio\Package\Wallet\Exceptions\ConfirmedInvalid;
use Incevio\Package\Wallet\Exceptions\WalletOwnerInvalid;
use Incevio\Package\Wallet\Test\Models\Buyer;
use Incevio\Package\Wallet\Test\Models\UserConfirm;

class ConfirmTest extends TestCase
{
    /**
     * @return void
     */
    public function testSimple(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->deposit(1000, ['desc' => 'unconfirmed'], false);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);

        $wallet->confirm($transaction);
        self::assertEquals($transaction->amount, $wallet->balance);
        self::assertTrue($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testSafe(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->forceWithdraw(1000, ['desc' => 'unconfirmed'], false);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);

        $wallet->safeConfirm($transaction);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testSafeResetConfirm(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->forceWithdraw(1000, ['desc' => 'confirmed']);
        self::assertEquals(-1000, $wallet->balance);
        self::assertTrue($transaction->confirmed);

        $wallet->safeResetConfirm($transaction);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testWithdraw(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;
        $wallet->deposit(100);

        self::assertEquals(100, $wallet->balance);

        $transaction = $wallet->withdraw(50, ['desc' => 'unconfirmed'], false);
        self::assertEquals(100, $wallet->balance);
        self::assertFalse($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testForce(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->forceWithdraw(1000, ['desc' => 'unconfirmed'], false);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);

        $wallet->forceConfirm($transaction);
        self::assertEquals($transaction->amount, $wallet->balance);
        self::assertTrue($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testUnconfirmed(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->forceWithdraw(1000, ['desc' => 'confirmed']);
        self::assertEquals(-1000, $wallet->balance);
        self::assertTrue($transaction->confirmed);

        $wallet->resetConfirm($transaction);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);
    }

    /**
     * @return void
     */
    public function testConfirmedInvalid(): void
    {
        $this->expectException(ConfirmedInvalid::class);
        $this->expectExceptionMessageStrict(trans('wallet::lang.confirmed_invalid'));

        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->deposit(1000);
        self::assertEquals(1000, $wallet->balance);
        self::assertTrue($transaction->confirmed);

        $wallet->confirm($transaction);
    }

    /**
     * @return void
     */
    public function testUnconfirmedInvalid(): void
    {
        $this->expectException(ConfirmedInvalid::class);
        $this->expectExceptionMessageStrict(trans('wallet::lang.unconfirmed_invalid'));

        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->deposit(1000, null, false);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);

        $wallet->resetConfirm($transaction);
    }

    /**
     * @return void
     */
    public function testSafeUnconfirmed(): void
    {
        /**
         * @var Buyer $buyer
         */
        $buyer = factory(Buyer::class)->create();
        $wallet = $buyer->wallet;

        self::assertEquals(0, $wallet->balance);

        $transaction = $wallet->deposit(1000, null, false);
        self::assertEquals(0, $wallet->balance);
        self::assertFalse($transaction->confirmed);
        self::assertFalse($wallet->safeResetConfirm($transaction));
    }

    /**
     * @return void
     */
    public function testWalletOwnerInvalid(): void
    {
        $this->expectException(WalletOwnerInvalid::class);
        $this->expectExceptionMessageStrict(trans('wallet::lang.owner_invalid'));

        /**
         * @var Buyer $first
         * @var Buyer $second
         */
        [$first, $second] = factory(Buyer::class, 2)->create();
        $firstWallet = $first->wallet;
        $secondWallet = $second->wallet;

        self::assertEquals(0, $firstWallet->balance);

        $transaction = $firstWallet->deposit(1000, ['desc' => 'unconfirmed'], false);
        self::assertEquals(0, $firstWallet->balance);
        self::assertFalse($transaction->confirmed);

        $secondWallet->confirm($transaction);
    }

    /**
     * @return void
     */
    public function testUserConfirm(): void
    {
        /**
         * @var UserConfirm $userConfirm
         */
        $userConfirm = factory(UserConfirm::class)->create();
        $transaction = $userConfirm->deposit(100, null, false);
        self::assertEquals($transaction->wallet->id, $userConfirm->wallet->id);
        self::assertEquals($transaction->payable_id, $userConfirm->id);
        self::assertInstanceOf(UserConfirm::class, $transaction->payable);
        self::assertFalse($transaction->confirmed);

        self::assertTrue($userConfirm->confirm($transaction));
        self::assertTrue($transaction->confirmed);
    }
}
