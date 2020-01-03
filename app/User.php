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
        'cover_thumb',
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
     * Get the user photo (cover) path
     *
     * @return string
     */
    public function getUrlCoverAttribute(): string
    {
        return !empty($this->cover) ? Storage::url($this->cover) : '';
    }

    /**
     * Get the user thumb (cover_thumb) path
     *
     * @return string
     */
    public function getUrlCoverThumbAttribute(): string
    {
        return !empty($this->cover_thumb) ? Storage::url($this->cover_thumb) : '';
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
        return date('d/m/Y', strtotime($this->attributes['date_of_birth']));
    }

    /**
     * Mutator "date_of_birth", set age attribute
     *
     * @param string|null $date_of_birth
     * @return void
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

}
