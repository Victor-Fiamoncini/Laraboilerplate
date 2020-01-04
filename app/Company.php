<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The primary-key attribute.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Table name attribute.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user',
        'social_name',
        'alias_name',
        'document_company',
        'document_company_secondary',
        'zipcode',
        'street',
        'city',
        'state',
        'number',
        'complement',
        'neighborhood',
    ];

    /**
     * "User" relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
