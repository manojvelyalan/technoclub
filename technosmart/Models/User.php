<?php
namespace Technosmart\Models;

class User extends BaseModel{
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'username',
        'password', 
      ];
}
