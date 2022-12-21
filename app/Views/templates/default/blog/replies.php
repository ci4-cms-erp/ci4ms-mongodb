<div class="card">
    <div class="card-body">
        <?php foreach ($replies as $reply) { ?>
            <div class="d-flex mt-4">
                <div class="flex-shrink-0"><img class="rounded-circle"
                                                src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                                alt="..."/></div>
                <div class="ms-3">
                    <div class="fw-bold"><?= $reply->comFullName ?></div>
                    <?= $reply->comMessage ?>
                </div>
            </div>
        <?php } ?>
        <hr>
        <div class="w-100 mt-2">
            <button class="btn btn-sm btn-outline-primary w-100" id="loadMore<?=(string)$replies[0]->parent_id?>" onclick="loadMore('<?=(string)$replies[0]->blog_id?>','<?=(string)$replies[0]->parent_id?>')" data-skip="3" data-defskip="3"><i class=""></i> Load More</button>
        </div>
    </div>
</div>
<?php

/*$invoice['invoice_id'] = "345345535"; // One unique id which will  be available in the return or cancel URL
$invoice['invoice_description'] = "INVOICE  TEST DESCRIPTION";
$invoice['total'] = 1300;
$invoice['discount'] = 220; //The amount of coupon code or discount value
$invoice['coupon'] = "3XY8P";  //coupon code in  case applicable
$invoice['return_url'] = "https://your_success_url";
$invoice['cancel_url'] = "https://your_fail_or_cancel_url";
$invoice['items'] = array(
    array("name" => "Item1", "price" => 200, "quantity" => 2, "description" => "item1 description"),
    array("name" => "Item2", "price" => 100, "quantity" => 1, "description" => "item2 description"),
    array("name" => "Item3", "price" => 400, "quantity" => 2, "description" => "item3 description"),
);
//billing info
$invoice['bill_address1'] = 'Address 1'; //should not more than 100 characters
$invoice['bill_address2'] = 'Address 2'; //should not more than 100 characters
$invoice['bill_city'] = 'Istanbul';
$invoice['bill_postcode'] = '1111';
$invoice['bill_state'] = 'Istanbul';
$invoice['bill_country'] = 'TURKEY';
$invoice['bill_phone'] = '008801777711111';
$invoice['bill_email'] = 'demo@fastpay.com.tr';
$invoice['sale_web_hook_key'] = 'sale_web_hook_key';// This key must be assigned on Fastpay Merchant Panel
$invoice['trasaction_type'] = 'Pre-Authorization'; //Optional

//Recurring info
$invoice['order_type'] = 1; //order type 1 for recurring payment
$invoice[' recurring_payment_number'] = 2; //must be integer value
$invoice[' recurring_payment_cycle'] = 'M'; // e.g:  D, M, Y
$invoice[' recurring_payment_interval'] = 2;  //must be integer value
$invoice[' recurring_web_hook_key'] = "key_name";  //This key must be assigned in the Fastpay merchant panel.

echo json_encode($invoice);*/