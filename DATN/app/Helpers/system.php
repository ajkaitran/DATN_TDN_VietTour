<?php
function uploadFile($nameFodel, $file){
    $fileName = time().'_'.$file->getClientOriginalName();
    return $file->storeAs($nameFodel, $fileName, 'public');
}   