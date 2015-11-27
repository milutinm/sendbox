<?php
/**
 * Author: Milutin Milovanovic
 * Date: 27/11/15
 * Time: 01:02
 */

namespace app\model;

require_once BASE_DIR.'/classes/ganon.php';

/**
 * Class parser
 * @package app\model
 */
class parser
{
    protected $html;
    private $url;

    /**
     * loading data from url
     * @param $url
     */
    public function get_url($url)
    {
        $this->url  = $url;
        $this->html = file_get_dom($this->url);
    }

    /**
     * return required item
     * @param $item     css selector
     * @return mixed    html as plaintext
     */
    public function get_item($item) {
        $out = $this->html;

        return $out($item,0)->getOuterText();
    }
}