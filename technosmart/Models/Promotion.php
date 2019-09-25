<?php
namespace Technosmart\Models;
class Promotion extends BaseModel{
 protected $fillable = [
    'title',
    'code',
    'startDate',
    'endDate',
    'amount',
    'status' ,
 ];

}
