<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $writer_id
 * @property integer $editor_id
 * @property string $title
 * @property string $content
 * @property string $due_date
 * @property integer $word_count
 * @property integer $require_words
 * @property boolean $count_filled
 * @property string $url
 * @property string $geo
 * @property string $live_url
 * @property string $site_url
 * @property boolean $copy_scape_check
 * @property boolean $approved
 * @property string $created_at
 * @property string $updated_at
 * @property Administrator $adminUser_writer
 * @property Administrator $adminUser_editor
 * @property Revision[] $revisions
 */
class Content extends Model
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
    protected $fillable = ['writer_id', 'editor_id', 'title', 'content', 'due_date', 'word_count', 'require_words', 'count_filled', 'url', 'geo', 'live_url', 'site_url', 'copy_scape_check', 'approved', 'created_at', 'updated_at'];

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
