<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class TagsRel extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\Tags')
            ->withTimestamps();
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getByWork(int $workId)
    {
        $tags = $this->select('tags.tag', 'tags.id', 'tags_rels.workId')->join('tags', 'tags.id', '=', 'tags_rels.tagId')->where('tags_rels.workId', $workId)->get();
        if (empty($tags) || empty($tags->toArray())) {
            return [];
        }
        return $tags->toArray();
    }

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public function deleteByWork(int $workId)
    {
        return $this->where('tags_rels.workId', $workId)->delete();
    }

    /**
     * @param int $workId
     * @param int $tagId
     *
     * @return mixed
     */
    public function deleteFromWork(int $workId, int $tagId)
    {
        return $this->where('workId', $workId)->where('tagId', $tagId)->delete();
    }

    /**
     * @param int $tagId
     *
     * @return mixed
     */
    public function deleteByTag(int $tagId)
    {
        return $this->where('tags_rels.tagId', $tagId)->delete();
    }

    /**
     * @param $tagId
     * @param $workId
     *
     * @return mixed
     */
    public function addToWork($tagId, $workId)
    {
        $rel = new self();
        $rel->tagId = $tagId;
        $rel->workId = $workId;
        $rel->save();
        return $rel->id;
    }
}