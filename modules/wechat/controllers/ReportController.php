<?php
class ReportController extends WController{
    public function actionDefault(){
        $this->render("default");
    }

    public function actionindex(){
        $total = Wxbox::model()->count();
        $page = 10;
        $data = $this->getPageInfo($page);
        $list = ReportManager::getUserList($data);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$list['count'],$page,$data['currentPage']);
        $this->render('index',array('province'=>$list['list'],'page'=>$pagination,'total'=>$total));
    }
}
?>