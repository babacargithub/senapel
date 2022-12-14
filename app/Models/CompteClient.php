<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteClient extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'solde',
        'client_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function augmenterSolde(float $montant)
    {
     $this->solde = $this->solde + $montant;
    }
    public function diminuerSolde(float $montant)
    {
     $this->solde = $this->solde - $montant;
    }

}
