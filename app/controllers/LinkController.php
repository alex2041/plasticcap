<?php

class LinkController extends IController{

    public function indexAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $limit = 5;
        $page = $params['page'] ? $params['page'] : 1;

        $link = new Link();
        $caps = new Cap();

        $arr = [
            'countB' => $caps->countBy('b_id'),
            'link' => $link->fetch([
                $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                $limit
            ]),
            'pg' => [
                'page' => $page, 'limit' => $limit, 'count' => $link->count()
            ]
        ];

        $output = $this->render(LINK, $arr);

        $fc->setBody($output);
    }
}