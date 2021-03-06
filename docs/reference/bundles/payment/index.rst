.. index::
    single: Payment

=======
Payment
=======

At this time, several payment methods are handled in Sonata e-commerce. Whether you'd like to use credit card payment providers such as Scellius or Ogone ; simply Paypal ; or even want the ability to handle check payments, you should find what you need in what's already provided. Otherwise, you may of course add your own payment methods (and feel free to submit them to the community).

#TODO Describe how to add a payment method

You may get more details about the architecture here: :doc:`../../architecture/payment`.

Methods
=======

.. toctree::
    :maxdepth: 2

    Scellius (Credit Card) <scellius>
    Ogone (Credit Card) <ogone>
    Paypal <paypal>
    Check <check>
    Pass <pass>


Configuration
=============

Here's the full default configuration for SonataPaymentBundle:

.. code-block:: yaml

    sonata_payment:
        selector:             sonata.payment.selector.simple
        generator:            sonata.payment.generator.mysql
        transformers:
            order:                sonata.payment.transformer.order      # The service to transform an order into a basket
            basket:               sonata.payment.transformer.basket     # The service to transform a basket into an order
        services:
            # Which payment methods are enabled?
            paypal:
                name:                 Paypal
                enabled:              ~ # Required
                code:                 paypal
                transformers:
                    basket:               sonata.payment.transformer.basket
                    order:                sonata.payment.transformer.order
                options:
                    shop_secret_key:      ~
                    web_connector_name:   curl
                    account:              your_paypal_account@fake.com
                    cert_id:              fake
                    debug:                false
                    paypal_cert_file:     %kernel.root_dir%/paypal_cert_pem_sandbox.txt
                    url_action:           https://www.sandbox.paypal.com/cgi-bin/webscr
                    class_order:          Application\Sonata\OrderBundle\Entity\Order
                    url_callback:         sonata_payment_callback
                    url_return_ko:        sonata_payment_error
                    url_return_ok:        sonata_payment_confirmation
                    method:               encryptViaBuffer
                    key_file:             %kernel.root_dir%/my-prvkey.pem
                    cert_file:            %kernel.root_dir%/my-pubcert.pem
                    openssl:              /opt/local/bin/openssl
            pass:
                name:                 Pass
                enabled:              ~ # Required
                code:                 pass
                transformers:
                    basket:               sonata.payment.transformer.basket
                    order:                sonata.payment.transformer.order
                browser:              sonata.payment.browser.curl
                options:
                    shop_secret_key:      ~
                    url_callback:         sonata_payment_callback
                    url_return_ko:        sonata_payment_error
                    url_return_ok:        sonata_payment_confirmation
            check:
                name:                 Check
                enabled:              ~ # Required
                code:                 check
                transformers:
                    basket:               sonata.payment.transformer.basket
                    order:                sonata.payment.transformer.order
                browser:              sonata.payment.browser.curl
                options:
                    shop_secret_key:      ~
                    url_callback:         sonata_payment_callback
                    url_return_ko:        sonata_payment_error
                    url_return_ok:        sonata_payment_confirmation
            scellius:
                name:                 Scellius
                enabled:              ~ # Required
                code:                 scellius
                generator:            sonata.payment.provider.scellius.none_generator
                transformers:
                    basket:               sonata.payment.transformer.basket
                    order:                sonata.payment.transformer.order
                options:
                    url_callback:         sonata_payment_callback
                    url_return_ko:        sonata_payment_error
                    url_return_ok:        sonata_payment_confirmation
                    template:             SonataPaymentBundle:Payment:scellius.html.twig
                    shop_secret_key:      ~
                    request_command:      ~
                    response_command:     ~
                    merchant_id:          ~
                    merchant_country:     ~
                    pathfile:             ~
                    language:             ~
                    payment_means:        ~
                    base_folder:          ~
                    data:
                    header_flag:          no
                    capture_day:
                    capture_mode:
                    bgcolor:
                    block_align:
                    block_order:
                    textcolor:
                    normal_return_logo:
                    cancel_return_logo:
                    submit_logo:
                    logo_id:
                    logo_id2:
                    advert:
                    background_id:
                    templatefile:
            ogone:
                name:                 Ogone
                enabled:              ~ # Required
                code:                 ogone
                transformers:
                    basket:               sonata.payment.transformer.basket
                    order:                sonata.payment.transformer.order
                options:
                    url_callback:         sonata_payment_callback
                    url_return_ko:        sonata_payment_error
                    url_return_ok:        sonata_payment_confirmation
                    form_url:             ~ # Required
                    catalog_url:          ~ # Required
                    home_url:             ~ # Required
                    pspid:                ~ # Required
                    sha_key:              ~ # Required
                    sha-out_key:          ~ # Required
                    template:             SonataPaymentBundle:Payment:ogone.html.twig
        class:
            order:                Application\Sonata\OrderBundle\Entity\Order
            transaction:          Application\Sonata\PaymentBundle\Entity\Transaction