<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;

class BusinessSettingController extends Controller
{

    public function general()
    {
        return view('backend.settings.general');
    }

    // Set App Name
    public function set_app_name(Request $request)
    {
        $request->validate([
            'app_name' => 'string'
        ]);

        $app_name = BusinessSetting::where('key', 'app_name')->first();

        if ($app_name) {
            $app_name->value = $request->app_name;
            $app_name->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'app_name';
            $setting->value = $request->app_name;
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "App Name Has Been Updated");
    }

    // Set App Logo
    public function set_app_logo(Request $request)
    {
        $request->validate([
            'app_logo' => 'file|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $app_logo = BusinessSetting::where('key', 'app_logo')->first();

        if ($app_logo) {
            deleteImage($app_logo->value);
            $app_logo->value = uploadImage($request->app_logo);
            $app_logo->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'app_logo';
            $setting->value = uploadImage($request->app_logo);
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "App Logo Has Been Updated");
    }

    // Set App Logo
    public function set_app_icon(Request $request)
    {
        $request->validate([
            'app_icon' => 'file|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $app_icon = BusinessSetting::where('key', 'app_icon')->first();

        if ($app_icon) {
            deleteImage($app_icon->value);
            $app_icon->value = uploadImage($request->app_icon);
            $app_icon->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'app_icon';
            $setting->value = uploadImage($request->app_icon);
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "App Logo Has Been Updated");
    }

    // Set Meta Description
    public function set_meta_description(Request $request)
    {
        $request->validate([
            'meta_description' => 'string'
        ]);

        $meta_description = BusinessSetting::where('key', 'meta_description')->first();

        if ($meta_description) {
            $meta_description->value = $request->meta_description;
            $meta_description->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'meta_description';
            $setting->value = $request->meta_description;
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "Meta Description Has Been Updated");
    }

    // Set Meta Description
    public function set_meta_tags(Request $request)
    {
        $request->validate([
            'meta_tags' => 'string'
        ]);

        $meta_tags = BusinessSetting::where('key', 'meta_tags')->first();

        if ($meta_tags) {
            $meta_tags->value = $request->meta_tags;
            $meta_tags->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'meta_tags';
            $setting->value = $request->meta_tags;
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "Meta Description Has Been Updated");
    }

    // Set Whatsapp Number
    public function set_whatsapp_number(Request $request)
    {
        $request->validate([
            'whatsapp' => 'string|numeric'
        ]);

        $whatsapp = BusinessSetting::where('key', 'whatsapp_number')->first();

        if ($whatsapp) {
            $whatsapp->value = $request->whatsapp;
            $whatsapp->save();
        } else {
            $setting = new BusinessSetting();
            $setting->key = 'whatsapp_number';
            $setting->value = $request->whatsapp;
            $setting->save();
        }

        return redirect()->route('admin.settings.general')->with('success', "Whatsapp Number Has Been Updated");
    }
}
