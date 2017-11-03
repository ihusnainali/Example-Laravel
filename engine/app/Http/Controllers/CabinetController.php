<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\User;
use RecycleArt\Models\Work;

/**
 * Class CabinetController
 * @package RecycleArt\Http\Controllers
 */
class CabinetController extends Controller
{
    /**
     * CabinetController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $works = Work::getInstance()->getListByUserId($userId);
        return view('cabinet.index', ['works' => $works]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('cabinet.profile');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function profileUpdate(Request $request)
    {
        if (!empty($request->file('avatar'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,bmp,png',
            ]);
        }
        User::getInstance()->updateProfile($request);
        $request->session()->flash('updateResult', __('cabinet.accountUpdated'));
        return Redirect::to('/cabinet/profile');
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    public function removeAvatar(Request $request)
    {
        if (User::getInstance()->removeAvatar()) {
            $request->session()->flash('updateResult', __('cabinet.AvatarSuccessRemoved'));
            return Redirect::to('/cabinet/profile');
        }
        $request->session()->flash('updateResult', __('cabinet.AvatarErrorRemoved'));
        return Redirect::to('/cabinet/profile');
    }
}
