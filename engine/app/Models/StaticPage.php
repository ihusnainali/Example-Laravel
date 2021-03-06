<?php

namespace RecycleArt\Models;

use Illuminate\Http\Request;

/**
 * Class StaticPage
 * @package RecycleArt\Models
 */
class StaticPage extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'slug';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @param string $slug
     *
     * @return array
     */
    public function getBy(string $slug): array
    {
        $page = self::find($slug);
        if (!$this->checkEmptyObject($page)) {
            return [];
        }
        return $page->toArray();
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $all = self::All();
        if (!$this->checkEmptyObject($all)) {
            return [];
        }
        return $all->toArray();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateOrMake(Request $request): bool
    {
        $slug    = $request->post('slug', false);
        $name    = $request->post('name', false);
        $content = $request->post('content', false);

        if (empty($slug)) {
            return false;
        }
        $page = self::find($slug);
        if (!$this->checkEmptyObject($page)) {
            $page = new self();
            $page->slug = $slug;
        }
        if ($name) {
            $page->name = $name;
        }
        if ($content) {
            $page->content = $content;
        }
        return $page->save();
    }

    /**
     * @param string $slug
     *
     * @return bool
     */
    public function removePage(string $slug): bool
    {
        return $this->where('slug', $slug)->delete();
    }
}