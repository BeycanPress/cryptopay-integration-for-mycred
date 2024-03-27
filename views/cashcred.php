
<div id="panel_<?php echo esc_attr($key); ?>" class="cashcred_panel">

<h3><?php echo esc_html(apply_filters('mycred_cashcred_cryptopay_title', __('CryptoPay Details', 'mycred-cryptopay'))); ?></h3>

<?php do_action('mycred_cashcred_before_cryptopay_form'); ?>

<div class="form-group">
    <div>
        <label>
            <?php esc_html_e('Payment network', 'mycred-cryptopay'); ?>
        </label>
    </div>
    <div>
        <select name="cashcred_user_settings[cryptopay][network]" class="form-control mycred-cryptopay-network">
            <?php foreach ($this->networks as $networkItem) : ?>
                <option value='<?php echo wp_json_encode($networkItem) ?>' <?php echo esc_attr($this->isSelected($network, $networkItem) ? 'selected' : ''); ?>>
                    <?php echo esc_html($networkItem['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <div>
        <label>
            <?php esc_html_e('Payment currency', 'mycred-cryptopay'); ?>
        </label>
    </div>
    <div>
        <select name="cashcred_user_settings[cryptopay][currency]" class="form-control mycred-cryptopay-currency">
            <?php
            if (!$this->currentNetwork) {
                $this->currentNetwork = $this->networks[0];
            }
            foreach ($this->currentNetwork['currencies'] as $currencyItem) : ?>
                <option value='<?php echo wp_json_encode($currencyItem) ?>' <?php echo esc_attr(isset($currency->symbol) && $currencyItem['symbol'] == $currency['symbol'] ? 'selected' : ''); ?>>
                    <?php echo esc_html($currencyItem['symbol']) ?>
                </option>
            <?php endforeach;
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <div>
        <label>
            <?php esc_html_e('Address', 'mycred-cryptopay'); ?>
        </label>
    </div>
    <div>
        <input value="<?php echo esc_attr($address); ?>" name="cashcred_user_settings[cryptopay][address]" class="form-control" type="text">
    </div>
</div>

<script>
    jQuery(document).on('change', '.mycred-cryptopay-network', function(e) {
        let currencies = JSON.parse(jQuery(this).val()).currencies;
        jQuery('.mycred-cryptopay-currency').html(`
            ${currencies.map(currency => `<option value='${JSON.stringify(currency)}'>${currency.symbol}</option>`).join('')}
        `);
    });
</script>

</div>