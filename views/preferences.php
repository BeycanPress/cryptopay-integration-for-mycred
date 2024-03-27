<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h3><?php esc_html_e('Settings', 'mycred-cryptopay'); ?></h3>
        <div class="form-group">
            <label for="<?php echo esc_attr($this->field_id('account')); ?>"><?php esc_html_e('Theme', 'mycred-cryptopay'); ?></label>
            <select name="<?php echo esc_attr($this->field_name('theme')); ?>" id="<?php echo esc_attr($this->field_id('theme')); ?>" class="form-control">
                <option value="light" <?php selected($this->prefs['theme'], 'light'); ?>><?php esc_html_e('Light', 'mycred-cryptopay'); ?></option>
                <option value="dark" <?php selected($this->prefs['theme'], 'dark'); ?>><?php esc_html_e('Dark', 'mycred-cryptopay'); ?></option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h3><?php esc_html_e('Setup', 'mycred-cryptopay'); ?></h3>
        <div class="form-group">
            <label for="<?php echo esc_attr($this->field_id('currency')); ?>"><?php esc_html_e('Currency', 'mycred-cryptopay'); ?></label>

            <?php $this->currencies_dropdown('currency', 'mycred-gateway-cryptopay-currency'); ?>

        </div>
        <div class="form-group">
            <label><?php esc_html_e('Exchange Rates', 'mycred-cryptopay'); ?></label>

            <?php $this->exchange_rate_setup(); ?>

        </div>
    </div>
</div>