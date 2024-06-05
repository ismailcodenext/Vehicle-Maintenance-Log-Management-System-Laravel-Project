<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $primaryKey = ['id', 'service_type_id'];
    public $incrementing = false;

    protected $fillable = [
        'id',
        'service_type_id',
        'service_name',
        'service_provider_id',
        'service_interval',
        'service_description',
        'user_id',
    ];

    // This function is required to use a composite primary key
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        return $this->getAttribute($keyName);
    }


    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
