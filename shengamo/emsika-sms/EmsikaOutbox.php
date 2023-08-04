<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmsikaOutbox extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'outboxes';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'mobile', 'msg', 'status','sent_at'];

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

    protected function sentAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value)->format('d/m/y') : 'Not yet sent',
        );
    }

    public function sentStatus() : Attribute
    {
        return Attribute::make(
            get: function (){
                if($this->status==1){
                    return 'Sent';
                }
                return "Unsent";
            }
        );
    }
}