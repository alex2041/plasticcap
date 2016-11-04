<?php

class BlogController extends IController{

    public function indexAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $limit = 5;
        $page = $params['page'] ? $params['page'] : 1;

        $blog = new Blog();
        $caps = new Cap();

        $arr = [
            'countB' => $caps->countBy('b_id'),
            'blog' => $blog->fetch([
                $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                $limit
            ]),
            'pg' => [
                'page' => $page, 'limit' => $limit, 'count' => $blog->count()
            ]
        ];

        if($fc->isAjax()){
            $output = $this->render(POST, $arr);
        }else{
            $output = $this->render(BLOG, $arr);
        }

        $fc->setBody($output);
    }
}