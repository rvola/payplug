<?php

namespace Payplug\PayplugWoocommerce\Gateway\PPRO;
use Payplug\PayplugWoocommerce\Controller\PayplugGenericGateway;

class Giropay extends PayplugGenericGateway
{

	protected $min_thresholds;
	protected $max_thresholds;
	protected $allowed_country_codes = [];

	public function __construct()
	{

		parent::__construct();

		//since we're calling the parent construct we need to redefine the payment properties
		//once we detach the cc from default payment method, this will be no longer needed
		$this->id = 'giropay';
		$this->method_title = __("pay_with_giropay", "payplug");
		$this->title = __("pay_with_giropay", "payplug");
		$this->method_description = "";
		$this->description = "";
		$this->image = 'giropay.svg';

		//WOOCO FIELDS
		$this->has_fields = false;
		$this->enabled = "yes";

		if (!$this->checkGateway()) {
			$this->enabled = "no";
		}

		add_action('woocommerce_order_item_add_action_buttons', [$this, 'refund_not_available']);

	}

}
