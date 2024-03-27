<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\MyCred;

use BeycanPress\CryptoPay\Integrator\Hook;
use BeycanPress\CryptoPay\Integrator\Helpers;

class Loader
{
    /**
     * Loader constructor.
     */
    public function __construct()
    {
        Helpers::registerIntegration('mycred');

        Helpers::createTransactionPage(
            esc_html__('myCred Transactions', 'ninjaforms-cryptopay'),
            'mycred',
            10,
            [],
            ['orderId']
        );

        Hook::addAction('payment_finished_mycred', [$this, 'paymentFinished']);
        Hook::addFilter('payment_redirect_urls_mycred', [$this, 'paymentRedirectUrls']);

        add_filter('mycred_setup_gateways', [$this, 'registerGateway']);
    }

    /**
     * @param object $data
     * @return void
     */
    public function paymentFinished(object $data): void
    {
        $order = $data->getOrder();
        $gateway = buycred_gateway('cryptopay');
        $pendingPayment = $gateway->get_pending_payment($order->getId());
        if ($data->getStatus()) {
            if ($gateway->complete_payment($pendingPayment, $data->getHash())) {
                $gateway->trash_pending_payment($order->getId());
            } else {
                $gateway->log_call($order->getId(), [
                    sprintf(esc_html__('Failed to credit users account.', 'mycred-cryptopay'))
                ]);
            }
        } else {
            $gateway->log_call($order->getId(), [
                sprintf(__('Payment not completed. Transaction hash: %s', 'mycred-cryptopay'), $data->getHash())
            ]);
        }
    }

    /**
     * @param object $data
     * @return array<string>
     */
    public function paymentRedirectUrls(object $data): array
    {
        $gateway = buycred_gateway('cryptopay');
        return [
            'success' => $gateway->get_thankyou(),
            'failed' => $gateway->get_cancelled()
        ];
    }

    /**
     * @param array<mixed> $gateways
     * @return array<mixed>
     */
    public function registerGateway(array $gateways): array
    {
        $gateways['cryptopay'] = [
            'title'         => Helpers::exists() ? 'CryptoPay' : 'CryptoPay Lite',
            'documentation' => 'https://beycanpress.gitbook.io/cryptopay-docs/overview/welcome',
            'callback'      => [Gateway::class],
            'icon'          => 'dashicons-admin-generic',
            'external'      => true,
            'custom_rate'   => true
        ];

        return $gateways;
    }
}
