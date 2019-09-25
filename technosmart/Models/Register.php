<?php
namespace Technosmart\Models;
use Technosmart\Models\Discount;
class Register extends BaseModel {


    protected $fillable = [
      'first_name',
      'last_name',
      'grade',
      'school_name',
      'age',
      'parent_name',
      'email' ,
      'phone',
      'emergency_name',
      'emergency_number',
      'pickup',
      'is_usb',
      'status',
      'isDelete',
      'payment_id',
      'total_amount',
      'discount_amount',
      'discount_id',
      'promocode',
      'grand_total'
    ];
    public function programs(){
      return $this->belongsToMany('Technosmart\Models\Programs');
    }
    public function pickup(){
      return $this->hasOne('Technosmart\Models\Pickup','id','pickup');
    }

    public function payment(){
      return $this->hasOne('Technosmart\Models\Payment','id','payment_id');
    }

    public static function getDiscount($programId){

      $discountDetails = Discount::where('programId',$programId)->where('status',0)->whereRaw('(now() between startDate and endDate)')->first();
      return $discountDetails;
    }

}
