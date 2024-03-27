<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h3><?php esc_html_e('Settings', 'mycred-cryptopay'); ?></h3>
        <div class="form-group">
            <label for="<?php echo esc_attr( $this->field_id( 'minimum_amount' ) ); ?>"><?php esc_html_e( 'Minimum Points Withdrawal', 'mycred-cryptopay' ); ?></label>
            <input type="number" name="<?php echo esc_attr( $this->field_name( 'minimum_amount' ) ); ?>" id="<?php echo esc_attr( $this->field_id( 'minimum_amount' ) ); ?>"  min="1" value="<?php echo esc_attr( $this->prefs['minimum_amount'] ); ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="<?php echo esc_attr( $this->field_id( 'maximum_amount' ) ); ?>"><?php esc_html_e( 'Maximum Points Withdrawal', 'mycred-cryptopay' ); ?></label>
            <input type="number" name="<?php echo esc_attr( $this->field_name( 'maximum_amount' ) ); ?>" id="<?php echo esc_attr( $this->field_id( 'maximum_amount' ) ); ?>" value="<?php echo esc_attr( $this->prefs['maximum_amount'] ); ?>" class="form-control" />
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