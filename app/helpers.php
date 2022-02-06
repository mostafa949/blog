<?php

function categoryStorageFilePath($fileName): string
{
    return URL::to('storage/images/blog/categories/' . $fileName);
}
