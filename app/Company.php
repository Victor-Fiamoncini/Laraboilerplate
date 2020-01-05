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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    /**
     * Accessor "document_company"
     *
     * @param string $documentCompany
     * @return string
     */
    public function getDocumentCompanyAttribute(string $documentCompany): string
    {
        return
            substr($documentCompany, 0, 2) . '.' .
            substr($documentCompany, 2, 3) . '.' .
            substr($documentCompany, 5, 3) . '/' .
            substr($documentCompany, 8, 4) . '-' .
            substr($documentCompany, 12, 2);
    }

    /**
     * Mutator "document_company"
     *
     * @param string|null $documentCompany
     * @return null
     */
    public function setDocumentCompanyAttribute(?string $documentCompany): void
    {
        $this->attributes['document_company'] = $this->clearField($documentCompany);
    }

    /**
     * Mutator "document_company_secondary"
     *
     * @param string|null $documentCompanySecondary
     * @return null
     */
    public function setDocumentCompanySecondaryAttribute(?string $documentCompanySecondary): void
    {
        $this->attributes['document_company_secondary'] = $this->clearField($documentCompanySecondary);
    }

    /**
     * Accessor "zipcode"
     *
     * @param string $documentCompany
     * @return string
     */
    public function getZipcodeAttribute(string $zipcode): string
    {
        return substr($zipcode, 0, 5) . '-' . substr($zipcode, 5, 3);
    }

    /**
     * Mutator "zipcode"
     *
     * @param string|null $zipcode
     * @return null
     */
    public function setZipcodeAttribute(?string $zipcode): void
    {
        $this->attributes['zipcode'] = $this->clearField($zipcode);
    }

    /**
     * Remove special chars from field
     *
     * @param string|null $field
     * @return string
     */
    private function clearField(?string $field): string
    {
        return !empty($field) ? str_replace(['.', '-', ';', '_', ' ', '/'], '', $field) : '';
    }

}
