<?php

class ContentDataController extends VController
{
    public function actionIndex()
    {
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['title'])){
            $list['title']=$_REQUEST['title'];
        }
        if(!empty($_REQUEST['cp'])){
            $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
        if(!empty($_REQUEST['flag'])){
            $list['flag']=$_REQUEST['flag'];
        }
        $tmp =ContentDataManager::getData($data,$list);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $this->render('index',array('list'=>$tmp['list'],'page'=>$pagination));
    }

}
