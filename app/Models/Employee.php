<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee'; // Ensure this matches your database table name
    protected $fillable = ['fname', 'minit', 'lname', 'ssn', 'bdate', 'address', 'sex', 'salary', 'superSsn', 'dno']; // Adjust columns as per your table
}


