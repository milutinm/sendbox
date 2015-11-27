<?php
/**
 * Author: Milutin Milovanovic
 * Date: 27/11/15
 * Time: 00:58
 */

namespace app\controller;

/**
 * Class parser
 * @package app\controller
 */
class parser
{
    /**
     * default aciotn
     */
    public function indexAction() {
         $this->render('index');
    }

    /**
     * ajax action
     * @return string
     */
    public function parseAction() {
        // get model
        $parser = new \app\model\parser();

        $url    = $_POST['url'];
        $item   = $_POST['item'];

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return json_encode([
                'status'    => 0,
                'error'      => 'bad url'
            ]);
        }

        // validate item
        if (empty($item)) {
            return json_encode([
                'status'    => 0,
                'error'      => 'item empty'
            ]);
        }

        // load url
        $parser->get_url($url);

        // get item
        $item = $parser->get_item($item);

        $out = [
            'status'    => 1,
            'item'      => $item,
            'item_html' => htmlentities($item),
        ];

        return json_encode($out);
    }

    private function render($template) {
        include BASE_DIR.'/app/view/'.$template.'.php';
    }
}