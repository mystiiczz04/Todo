<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{

    protected $table = 'listes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'nomliste', 'description', 'done'];


}
?>
