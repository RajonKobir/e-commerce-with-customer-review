<?php

use App\Models\BusinessSetting;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (!function_exists('slugify')) {
    function slugify($string, $table)
    {
        // lowercase the string
        $string = strtolower($string);

        // use the Laravel Str::slug helper to generate a slug from the string
        $slug = Str::slug($string, '-');
        // check if the slug already exists in the database using the DB facade
        $exists = DB::table($table)->where('slug', $slug)->exists();
        // if it does, append a random number to the slug
        if ($exists) {
            $slug .= '-' . rand(1, 9999);
        }
        // return the slug
        return $slug;
    }
}



if (!function_exists('uploadImage')) {
    function uploadImage($image)
    {
        // check if the image is valid
        if ($image && $image->isValid()) {
            // generate a unique file name
            $imageName = time() . '.' . $image->extension();
            // store the image in the public folder
            $image->move(public_path('img'), $imageName);
            // return the file name
            return $imageName;
        } else {
            // return null if the image is not valid
            return null;
        }
    }
}

/**
 * Delete Images from public/images folder if exists
 *
 * @param Image   $image  The Input Image
 * 
 * 
 * @return String
 */
if (!function_exists('deleteImage')) {
    function deleteImage($image)
    {
        // check if the image exists in the public/images folder
        if (File::exists(public_path('img/' . $image))) {
            File::delete(public_path('img/' . $image));
        }
    }
}

if (!function_exists('get_categories')) {
    function get_categories()
    {
        $categories = Category::all();
        return $categories;
    }
}

/**
 * A Method to recall settings value
 *
 * @param String $key
 * @return String
 */
if (!function_exists('get_settings')) {
    function get_settings($key)
    {
        $setting = BusinessSetting::where("key", "=", $key)->first();

        return $setting->value ?? '';
    }
}
