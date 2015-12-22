<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{

    protected $table = 'taches';

    protected $fillable = ['liste', 'tache', 'date', 'done'];

}

?>
