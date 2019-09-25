<?php
namespace Technosmart\Models;
class Discount extends BaseModel{
 protected $fillable = [
    'title',
    'programId',
    'startDate',
    'endDate',
    'amount',
    'status' ,
 ];

 public function programs(){
   return $this->hasOne('Technosmart\Models\Programs','id','programId');
 }

}
