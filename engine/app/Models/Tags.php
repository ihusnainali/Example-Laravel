<?php

namespace RecycleArt\Models;

/**
 * Class Tags
 * @package RecycleArt\Models
 */
class Tags extends Model
{
    const DELIMITER = ',';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\TagsRel')
            ->withTimestamps();
    }

    /**
     * @param string $tagName
     *
     * @return array
     */
    public function getByName(string $tagName): array
    {
        $tag = $this->where('tag', $tagName)->first();
        if (!$this->checkEmptyObject($tag)) {
            return [];
        }
        return $tag->toArray();
    }

    /**
     * @param string $tagName
     *
     * @return int
     */
    public function add(string $tagName): int
    {
        $tag = new self();
        $tag->tag = $tagName;
        $tag->save();
        return $tag->id ?: 0;
    }

    /**
     * @param string $tagsString
     * @param int    $workId
     *
     * @return bool
     */
    public function addTagsToWork(string $tagsString = '', int $workId = 0): bool
    {
        if (empty($tagsString) || empty($workId)) {
            return false;
        }

        $tagsArray = \explode(self::DELIMITER, $tagsString);
        if (empty($tagsArray)) {
            return false;
        }

        foreach ($tagsArray as $tag) {
            $tag = \trim($tag, ' ');
            if (empty($tag)) {
                continue;
            }
            $existingTag = $this->getByName($tag);
            if (empty($existingTag)) {
                $existingTag['id'] = $this->add($tag);
            }
            $this->getTagsRelation()->addToWork($existingTag['id'], $workId);
        }
        return true;
    }

}


