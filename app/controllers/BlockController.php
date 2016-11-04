<?php

class BlockController extends IController{

    public function getAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();
        $limit = 24;
        $page = $params['page'] ? $params['page'] : 1;
        
        $caps = new Cap();

        if(!$params or $params['id'] == 'all'){
            $arr = [
                'caps' => $caps->fetch([
                    $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                    $limit
                ]),
                'pg' => [
                    'page' => $page, 'limit' => $limit, 'count' => $caps->count()
                ]
            ];
        }else{
            $arr = [
                'caps' => $caps->where('b_id', $params['id'], [
                    $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                    $limit
                ]),
                'pg' => [
                    'page' => $page, 'limit' => $limit, 'count' => $caps->countBy(null, ['b_id', $params['id']])
                ]
            ];
        }

        if($fc->isAjax()){
            $output = $this->render(CAPS, $arr);
        }else{
            $categories = new Cat(); $dirs = new Dir(); $blocks = new Block();

            if(!$params or $params['id'] == 'all'){
                $cat = $categories->allCat();
                $dir = $dirs->allDir();
            }else{
                $cat = $categories->catByBlock($params['id']);
                $dir = $dirs->dirByBlock($params['id']);
            }

            $output = $this->render(DEFAULT_FILE, [
                    'categories' => $cat,
                    'dirs' => $dir,
                    'blocks' => $blocks->fetch(),
                    'countB' => $caps->countBy('b_id'),
                ] + $arr);
        }

        $fc->setBody($output);
    }
}