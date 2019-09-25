<?php
namespace Technosmart\Models;
use Technosmart\Models\Register;
class Payment extends BaseModel{
    protected $fillable = [
        'transaction_id',
        'paid_amount',
        'payment_status',
    ];
    public function paymentCreate($data){
        $payment = self::create([
            'transaction_id'=>$data['transaction_id'],
            'paid_amount'=>$data['paid_amount'],
            'payment_status'=>$data['payment_status'],
            
        ]);
        $invoiceArray = explode("_",$data['invoice_id']);
        $register = Register::find($invoiceArray[0]);
        $register->update([
            'payment_id'=>$payment->id,
            'status'=>'paid',
        ]);
        return true;
    }
}
