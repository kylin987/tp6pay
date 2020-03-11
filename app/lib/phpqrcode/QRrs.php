<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 01:31
 */
namespace app\lib\phpqrcode;
class QRrs {

    public static $items = array();

    //----------------------------------------------------------------------
    public static function init_rs($symsize, $gfpoly, $fcr, $prim, $nroots, $pad)
    {
        foreach(self::$items as $rs) {
            if($rs->pad != $pad)       continue;
            if($rs->nroots != $nroots) continue;
            if($rs->mm != $symsize)    continue;
            if($rs->gfpoly != $gfpoly) continue;
            if($rs->fcr != $fcr)       continue;
            if($rs->prim != $prim)     continue;

            return $rs;
        }

        $rs = QRrsItem::init_rs_char($symsize, $gfpoly, $fcr, $prim, $nroots, $pad);
        array_unshift(self::$items, $rs);

        return $rs;
    }
}