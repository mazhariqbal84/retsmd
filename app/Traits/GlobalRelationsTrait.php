<?php

namespace App\Traits;

trait GlobalRelationsTrait
{
    public function initializeGlobalRelationsTrait()
    {
        $this->append([
            'created_user_name',
            'updated_user_name',
            'deleted_user_name'
        ]);
    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function deleted_user(){
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }

    public function getCreatedUserNameAttribute(){
        return $this->created_user()->pluck('name')->implode(',');
    }

    public function getUpdatedUserNameAttribute(){
        return $this->updated_user()->pluck('name')->implode(',');
    }

    public function getDeletedUserNameAttribute(){
        return $this->deleted_user()->pluck('name')->implode(',');
    }
}
