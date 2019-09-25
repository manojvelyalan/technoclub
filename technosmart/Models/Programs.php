<?php
namespace Technosmart\Models;

class Programs extends BaseModel{

 protected $table = 'programs';
 protected $fillable = [
    'programs',
    'day',
    'start_date',
    'end_date',
    'grade',
    'time' ,
    'seat',
    'fee',
    'description',
    'status',
    'date',
    'position',
    'program_category_id'
 ];

  public function category(){
      return $this->hasOne('Technosmart\Models\ProgramCategory','id','program_category_id'); 
  }
}
