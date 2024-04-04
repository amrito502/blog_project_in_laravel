<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
{
    public function admin_settings()
    {
        $setting = Settings::first();
        return view('admin.settings.settings', compact('setting'));
    }

    public function save_settings(Request $request)
    {

        $countData = Settings::count();
        if ($countData == 0) {
            $settings = new Settings;
            $settings->comment_auto = $request->comment_auto;
            $settings->user_auto = $request->user_auto;
            $settings->recent_limit = $request->recent_limit;
            $settings->popular_limit = $request->popular_limit;
            $settings->recent_comment_limit = $request->recent_comment_limit;
            $settings->save();
        }
        else
        {
            $firstData = Settings::first();
            $settings = Settings::find($firstData->id);
            $settings->comment_auto = $request->comment_auto;
            $settings->user_auto = $request->user_auto;
            $settings->recent_limit = $request->recent_limit;
            $settings->popular_limit = $request->popular_limit;
            $settings->recent_comment_limit = $request->recent_comment_limit;
            $settings->update();
        }



        return redirect()->back()->with('message', 'Settings Successfully Updated!');
    }
}
