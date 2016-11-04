<?php

class CapController extends IController{

	public function getAction(){
		$fc = FrontController::getInstance();
		$params = $fc->getParams();
		$limit = 24;
		$page = $params['page'] ? $params['page'] : 1;

		$caps = new Cap();

        if($params['b_id'] !== 'all'){
            $arr = [
                'caps' => $caps->whereAnd([
                    [array_keys($params)[0], array_values($params)[0]],
                    [array_keys($params)[1], array_values($params)[1]]
                ], [
                    $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                    $limit
                ]),
                'pg' => [
                    'page' => $page, 'limit' => $limit, 'count' => count($caps->whereAnd([
                        [array_keys($params)[0], array_values($params)[0]],
                        [array_keys($params)[1], array_values($params)[1]]
                    ]))
                ]
            ];
        }else{
            $arr = [
                'caps' => $caps->where(array_keys($params)[1], array_values($params)[1], [
                    $start = $params['page'] ? ($params['page'] - 1) * $limit : 0,
                    $limit
                ]),
                'pg' => [
                    'page' => $page, 'limit' => $limit, 'count' => count($caps->where(
                        array_keys($params)[1], array_values($params)[1]))
                ]
            ];
        }

        if($fc->isAjax()){
            $output = $this->render(CAPS, $arr);
        }else{
            $categories = new Cat(); $dirs = new Dir(); $blocks = new Block();


            if($params['b_id'] !== 'all'){
                $cat = $categories->catByBlock($params['b_id']);
                $dir = $dirs->dirByBlock($params['b_id']);
            }else{
                $cat = $categories->allCat();
                $dir = $dirs->allDir();
            }

            $output = $this->render(DEFAULT_FILE, [
                    'categories' => $cat,
                    'dirs' => $dir,
                    'blocks' => $blocks->fetch(),
                    'countB' => $caps->countBy('b_id'),
                    'params' => $params
                ] + $arr);
        }

        $fc->setBody($output);
    }
}