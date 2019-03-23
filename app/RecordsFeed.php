<?php

namespace App;

trait RecordsFeed
{

    public static function bootRecordsFeed()
    {
        static::created(function ($model) {
            $model->recordFeed('created');
        });

        // static::deleted(function ($model) {
        //     $model->recordFeed('created');
        // });

    }
    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }

    protected function recordFeed($event)
    {
        $this->feeds()->create([
            'user_id' => auth()->id(),
            'type' => $event . '_' . strtolower(class_basename($this)),
        ]);
    }
}
