<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suicidepreventions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'dateregister',
        'name',
        'invoice',
        'datecurrence',
        'cp',
        'states',
        'municipys',
        'colony',
        'datesuccess',
        'cpdeed',
        'statesdeed',
        'municipysdeed',
        'colonydeed',
        'personinformate',
        'curp',
        'description',
        'age',
        'datereindence',
        'date_created',
        'user_id',
        'sites_id',
        'actwas_id',
        'dependeces_id',
        'causes_id',
        'dependececanalize_id',
        'gender_id',
        'belief_id',
        'statecivil_id',
        'literacy_id',
        'childrens_id',
        'existence_id',
        'adictions_id',
        'diseases_id',
        'violence_id',
        'family_id',
        'school_id',
        'indetified_id',
        'meanemployeed_id',
        'activies_id',
        'active',

    ];
    protected $table = 'suicidepreventions';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

}
