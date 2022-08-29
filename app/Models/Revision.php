<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $request_id
 * @property integer $editor_id
 * @property integer $writer_id
 * @property integer $content_id
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property Content $content
 * @property Administrator $adminUser_writer
 * @property Request $request
 * @property Administrator $adminUser_editor
 */
class Revision extends Model
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
    protected $fillable = ['request_id', 'editor_id', 'writer_id', 'content_id', 'notes', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo('App\Models\Content');
    }

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
    public function request()
    {
        return $this->belongsTo('App\Models\Request');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminUser_writer()
    {
        return $this->belongsTo('App\Admin\Models\Administrator', 'writer_id');
    }
}
