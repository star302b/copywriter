<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $link_builder_id
 * @property integer $editor_id
 * @property integer $writer_id
 * @property string $name
 * @property string $description
 * @property string $geo
 * @property boolean $status
 * @property string $comments
 * @property string $created_at
 * @property string $updated_at
 * @property Administrator $adminUser_link_builder
 * @property Administrator $adminUser_writer
 * @property Administrator $adminUser_editor
 * @property Revision[] $revisions
 */
class Request extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['link_builder_id', 'editor_id', 'writer_id', 'name', 'description', 'geo', 'status', 'comments', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminUser_editor()
    {
        return $this->belongsTo('App\Admin\Models\Administrator', 'editor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminUser_link_builder_id()
    {
        return $this->belongsTo('App\Admin\Models\Administrator', 'link_builder_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminUser_writer()
    {
        return $this->belongsTo('App\Admin\Models\Administrator', 'writer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions()
    {
        return $this->hasMany('App\Models\Revision');
    }
}
