<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Models\Admin\SiteSetting;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\SiteSettingRequest;

class SiteSettingController extends Controller
{
    public function edit(SiteSetting $site_setting): View
    {
        abort_if(Gate::denies('edit-site-setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.site_setting.edit', compact('site_setting'));
    }

    public function update(SiteSettingRequest $request, SiteSetting $site_setting): RedirectResponse
    {
        $site_setting->update($request->validated());

        if($request->hasFile('image')){
            $filename = 'site-setting-'. time() . '.'.$request->file('image')->getClientOriginalExtension();
            $site_setting->updateImage($request->file('image')->storeAs('site-setting-image', $filename, 'public'),'single');
        }

        return redirect()->route('home')->with('success', 'SiteSetting updated Successfully!');
    }

}
