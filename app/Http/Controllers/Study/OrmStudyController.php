<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use App\Models\Study\Test;
class OrmStudyController extends Controller{
    public function getAll(){
        $list = Test::get_all();
        dump($list);
    }
}
?>