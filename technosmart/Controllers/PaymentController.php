<?php
namespace Technosmart\Controllers;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\Register;
use Technosmart\Models\Common;
use Technosmart\Models\Payment as PaypalPayment;
class PaymentController extends BaseController {

    public function payment($request, $response){
        $registerId = Common::encryptOrDecrypt('decrypt',$request->getParam('id'));
        $registerDetails = Register::find( $registerId);
        $programs = $registerDetails->programs;
        $data = [
                    'title'=>'Payment',
                    'register'=>'id="current"',
                    'details'=>$registerDetails,
                    'programs'=>$programs

        ];
        return $this->view->render($response,"payment.twig",$data);
    }

    public function request($request, $response){
        $registerId = $request->getParam('registerid');
        $registerDetails = Register::find( $registerId);

        $payableAmount  = $registerDetails->grand_total;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $currency = 'USD';
        $invoiceNumber = uniqid($registerDetails->id ."_");

        $amount = new Amount();
        $amount->setCurrency($currency)->setTotal($payableAmount);


        $transaction = new Transaction();
        $transaction->setAmount($amount)->setDescription("Technosmart total amount to pay $ $payableAmount")->setInvoiceNumber($invoiceNumber);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->settings['paypalConfig']['return_url'])->setCancelUrl($this->settings['paypalConfig']['cancel_url']);

        $payment = new Payment();
        $payment->setIntent('sale')->setPayer($payer) ->setTransactions([$transaction]) ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);

        } catch (Exception $e) {
            throw new \Exception('Unable to create link for payment');
        }


        header('location:' . $payment->getApprovalLink());
       return true;
    }

    public function response($request, $response){

        if (empty($request->getParam('paymentId')) || empty($request->getParam('PayerID'))) {
            throw new \Exception('The response is missing the paymentId and PayerID');
        }
        $payment = Payment::get($request->getParam('paymentId'), $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->getParam('PayerID'));
        try {
            // Take the payment
            $payment->execute($execution, $this->apiContext);

            try {
                $payment = Payment::get($request->getParam('paymentId'), $this->apiContext);
                $data = [
                    'transaction_id'=>$payment->id,
                    'paid_amount'=>$payment->transactions[0]->amount->total,
                    'payment_status'=>$payment->getState(),
                    'invoice_id'=>$payment->transactions[0]->invoice_number
                ];

             $paymentCreate = PaypalPayment::paymentCreate($data);

                if ($paymentCreate  === true && $data['payment_status'] === 'approved') {

                     //Payment successfully added, redirect to the payment complete page.

                    $this->flash->addMessage('success',"Your payment has been processed successfully.Please find the transaction number  $payment->id for future reference.");
                    return $response->withRedirect($this->router->pathFor('paypalsuccess'));

                } else {
                    // Payment failed
                    $this->flash->addMessage('error',"Something went wrong. Please contact administrator with the reference number $payment->id .");
                return $response->withRedirect($this->router->pathFor('paypalfailed'));
                }

            } catch (Exception $e) {
                $this->flash->addMessage('error',"Something went wrong. Please contact administrator.");
                return $response->withRedirect($this->router->pathFor('paypalfailed'));
            }

        } catch (Exception $e) {
            $this->flash->addMessage('error',"Transaction has been failed, please try after some time");
            return $response->withRedirect($this->router->pathFor('paypalfailed'));

        }

    }

    public function success($request, $response){
      $data = [
                  'title'=>'Paypal Payment Success',
                  'register'=>'id="current"',

      ];
      return $this->view->render($response,"payment/success.twig",$data);
    }
    public function failed($request, $response){
      $data = [
                  'title'=>'Paypal Payment Failed',
                  'register'=>'id="current"',

      ];
        return $this->view->render($response,"payment/failed.twig",$data);
    }
    public function cancelled($request, $response){
      $data = [
                  'title'=>'Paypal Payment Cancelled',
                  'register'=>'id="current"',

      ];
        return $this->view->render($response,"payment/cancelled.twig",$data);
    }
}
