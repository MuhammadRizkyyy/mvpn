<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MembershipPayment extends Model {
    protected $guarded = ['id'];
    protected $casts = ['proofs'=>'array','due_at'=>'datetime'];
}
