<?php
namespace Technosmart\Models;

class ProgramCategory extends BaseModel{

  protected $table = 'programs_category';

  public function programs(){
      return $this->hasMany('Technosmart\Models\Programs','program_category_id','id')->orderBy('position');
  }

}
