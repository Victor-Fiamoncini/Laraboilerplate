<?php

namespace App;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

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
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cover',
        'github_id',
        'google_id',
        'description',
        'date_of_birth',
        'age',
        'zipcode',
        'neighborhood',
        'street',
        'complement',
        'number',
        'city',
        'state',
        'telephone',
        'cell',
        'occupation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * "Company" relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'user', 'id');
    }

    /**
     * "Employee" relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'admin', 'id');
    }

    /**
     * Accessor "cover"
     *
     * @return string
     */
    public function getUrlCoverAttribute(): string
    {
        return !empty($this->cover) ? Storage::url($this->cover) : asset('assets/images/avatar.jpg');
    }

    /**
     * Mutator "password"
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Accessor "date_of_birth"
     *
     * @return string
     */
    public function getDateOfBirthAttribute(): string
    {
        return !empty($this->attributes['date_of_birth'])
            ? date('d/m/Y', strtotime($this->attributes['date_of_birth']))
            : '';
    }

    /**
     * Mutator "date_of_birth", fill "age" attribute
     *
     * @param string|null $date_of_birth
     * @return null
     */
    public function setDateOfBirthAttribute(?string $dateOfBirth): void
    {
        if (!empty($dateOfBirth)) {
            $date = DateTime::createFromFormat('d/m/Y', $dateOfBirth)->format('Y-m-d');
            $date = new DateTime($date);
            $now = new DateTime();
            $age = $now->diff($date)->y;

            $this->attributes['age'] = $age;
            $this->attributes['date_of_birth'] = $dateOfBirth;
        }
    }

    /**
     * Accessor "zipcode"
     *
     * @param string|null $documentCompany
     * @return string
     */
    public function getZipcodeAttribute(?string $zipcode): string
    {
        return !empty($zipcode) ? substr($zipcode, 0, 5) . '-' . substr($zipcode, 5, 3) : '';
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
