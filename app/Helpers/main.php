<?php


function aurl($url)
{
    return url('/admin' . $url);
}


// the image dynamic function
function UploadImages($dir, $image, $checkFunction = null)
{
   $saveImage = '';

   if(! File::exists(public_path('uploads').'/' . $dir)) { // if file or fiolder not exists
       /**
        *
        * @param $PATH Required
        * @param $mode Defualt 0775
        * @param create the directories recursively if doesn't exists
        */
       File::makeDirectory(public_path('uploads') . '/' . $dir, 0775, true); // create the dir or the
   }

   if (File::isFile($image)) {
       $name = $image->getClientOriginalName(); // get image name
       $extension  = $image->getClientOriginalExtension(); // get image extension
       $sha1       = sha1($name); // hash the image name
       $fileName   = rand(1, 1000000) . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the image

       if (! is_null($checkFunction)){
           if ($checkFunction($name)) {
               return false;
           }
       } else {
           // get the image realpath
           $uplodedImage = Image::make($image->getRealPath());

           $uplodedImage->save(public_path('uploads/' . $dir . '/' . $fileName), '100'); // save the image

           $saveImage = $dir . '/' . $fileName; // get the name of tyhe image and the dir that uploded in
       }
   }

   return $saveImage;
}


function ShowImage($image) {
    if (! is_null($image) && !empty($image) && File::exists(public_path('uploads').'/' . $image)) {
        return asset('uploads/' . $image);
    }
    return 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
}


function userCan($permission)
{
    if (session()->has('user.permissions')) {
        return in_array($permission, session('user.permissions'));
    } else {
        // get thye user permissions depinding on then roles
        $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
        // save the persdissions to can Chack on the persissions
        session()->put('user.permissions', $permissions);

        return in_array($permission, session('user.permissions'));
    }
}
