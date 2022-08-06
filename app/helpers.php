<?php

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;

function getAvatar($user)
{
    if (!empty($user->is_social_login)) {
        $avatar = $user->avatar;
    } else {
        $avatar = empty($user->avatar) ? '' : Storage::disk('public')->url($user->avatar);
    }
    return empty($avatar) ? Storage::disk('public')->url('profile/no-image.png') : ($avatar);
}


/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */
function saveResizeImage($file, $directory, $width)
{
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory("$directory");
    }

    $filename = Str::random() . time() . '.' . $file->getClientOriginalExtension();
    $path = "$directory/$filename";
    \Image::make($file)->resize($width, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    })->save("storage/$path");
    return $path;
}


/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save image in storage
 */
function saveImage($file, $directory)
{
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory("$directory");
    }

    $filename = Str::random() . time() . '.' . $file->getClientOriginalExtension();
    $path = "$directory/$filename";
    \Image::make($file)->save("storage/$path");
    return $path;
}

/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */

function saveCompanyLogo($file, $directory,$filename)
{

    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory($directory);
    }
    // dd($filename);
    return Storage::disk('public')->put($directory, $file);
}
/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */

function saveAdImage($file, $directory)
{
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory($directory);
    }
    return Storage::disk('public')->put($directory, $file);
}


/**
 * @param $file
 * @param $directory
 * @param $width
 * @return string
 * save resize image in storage
 */
function saveFile($file, $directory,$filename)
{
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory("$directory");
    }
    Storage::disk('public')->put($filename.'.'.$file->getClientOriginalExtension(),$file);
    return "$directory/$filename".'.'.$file->getClientOriginalExtension();

}

/**
 * @param $file
 * delete a file
 */
function deleteFile($file)
{
    if (!empty($file)) {
        $host = str_replace('www.', '', request()->getHttpHost());
        $scheme = request()->getScheme();
        $needles = [
            "{$scheme}://www.{$host}",
            "{$scheme}://{$host}"
        ];
        $file = str_replace($needles, '', $file);
        if ((file_exists(public_path($file)) || Storage::exists($file))) {
            file_exists(public_path($file)) ? unlink(public_path($file)) : Storage::delete($file);
        }
    }
}


