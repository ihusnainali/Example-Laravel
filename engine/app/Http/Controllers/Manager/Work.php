<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\WorkController;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\Work as WorkModel;
use RecycleArt\Models\WorkImages;

/**
 * Class Work
 * @package RecycleArt\Http\Controllers\Manager
 */
class Work extends ManagerController
{

    /**
     * @var \RecycleArt\Models\Work
     */
    protected $work;

    /**
     * User constructor.
     *
     * @param \RecycleArt\Models\Work $work
     */
    public function __construct(\RecycleArt\Models\Work $work)
    {
        $this->work = $work;
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        return \view('manager.work.list', ['works' => $this->work->getListForManager()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListUnapproved()
    {
        return \view('manager.work.list', ['works' => $this->work->getByApprove(false)]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListApproved()
    {
        return \view('manager.work.list', ['works' => $this->work->getByApprove(true)]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListByAuthor(int $id)
    {
        return \view('manager.work.list', ['works' => $this->work->getListByUserId($id)]);
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function approve(int $workId): array
    {
        return [
            'isApproved' => $this->work->toggleApprove($workId)
        ];
    }

    /**
     * @param Request    $request
     * @param WorkModel  $work
     * @param WorkImages $workImages
     * @param TagsRel    $tagsRel
     * @param int        $id
     *
     * @return mixed
     */
    public function remove(Request $request, WorkModel $work, WorkImages $workImages, TagsRel $tagsRel, int $id)
    {
        return 'Это нужно оплатить';

        if (!$this->checkWork($work, $request, $id)) {
            abort(401);
        }
        $workPath = \public_path(\sprintf(WorkController::WORK_PATH, Auth::id(), $id));
        $tagsRel->deleteByWork($id);
        $workImages->removeByWorkId($id);
        $work->removeById($id);

        File::cleanDirectory($workPath);
        if (\is_dir($workPath)) {
            \rmdir($workPath);
        }
        return Redirect::to(\route('managerIndex'));
    }
}
