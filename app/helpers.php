<?php

use App\Models\aboutjember;
use App\Models\article;
use App\Models\setting;

function get_setting_value($key){
    $data = setting::where("key", $key)->first();
    if(isset($data->value)){
        return $data->value;
    } else{
        return "empty";
    }
}

function get_article_data($key){
    $data = article::where('type', $key)->first();
    if(isset($data)){
        return $data;
    }
}

function get_aboutjember_data($key){
    $data = aboutjember::where('type', $key)->first();
    if(isset($data)){
        return $data;
    }
}
