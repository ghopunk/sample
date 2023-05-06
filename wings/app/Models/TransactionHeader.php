<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;
	
	public $timestamps = false;
	protected $table = 'transaction_header';
	protected $primaryKey = 'document_number';
	protected $keyType = 'int';
	
    protected $fillable = ['document_code', 'user', 'total', 'date'];
}
