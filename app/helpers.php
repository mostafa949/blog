<?php

// this function return to categories storage path for files & show images
function categoryStorageFilePath($fileName): string
{
    return URL::to('storage/images/blog/categories/' . $fileName);
}

// this function return to posts storage path for files & show images
function postStorageFilePath($fileName): string
{
    return URL::to('storage/images/blog/posts/' . $fileName);
}
