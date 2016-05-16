<?php
/**
  +------------------------------------------------------------------------------
 * 图像操作类库
  +------------------------------------------------------------------------------
 */
class Image{//类定义开始
    // 获取图像信息
    static function getImageInfo($img) {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }
    /** 生成缩略图
     * @param string     $source        原图
     * @param string     $target        生成图（为空或跟原图一样都将是覆盖原图）
     * @param int        $maxWidth      最大长度（为0则是不限）
     * @param int        $maxHeight     最大高度（为0则是不限）
     * @param boolean    $cut           是否裁剪（给出最大长度和最大高度才生效）
     */
    static function thumb($source,$target='',$maxWidth=800,$maxHeight=0,$cut=true) {
        // 获取原图信息
        $info = Image::getImageInfo($source);
        if ($info !== false) {
            $srcWidth = $info['width'];
            $srcHeight = $info['height'];
            $type = strtolower($info['type']);
            unset($info);
            $srcX = 0;
            $srcY = 0;
            if($cut && $maxWidth>0 && $maxHeight>0){
                $width = $maxWidth;
                $height = $maxHeight;
                if(($maxWidth/$maxHeight)>=($srcWidth/$srcHeight)){ //截高
                    $trueHeight = $srcWidth*($maxHeight/$maxWidth);
                    $srcY = ($srcHeight-$trueHeight)*0.5;
                    $srcHeight = $trueHeight;
                }else{ //截长
                    $trueWidth = $srcHeight*($maxWidth/$maxHeight);
                    $srcX = ($srcWidth-$trueWidth)*0.5;
                    $srcWidth = $trueWidth;
                }
            }else{
                // 计算缩放比例
                if($maxHeight == 0 && $maxWidth == 0){//不限高不限宽，调用这函数干嘛？
                    return false;
                }else if($maxHeight == 0){//限宽不限高（建议）
                    $scale = $maxWidth/$srcWidth;
                }else if($maxWidth == 0){//限高不限宽
                    $scale = $maxHeight/$srcHeight;
                }else{//限高限宽
                    $scale = min($maxWidth/$srcWidth,$maxHeight/$srcHeight);
                }
                if ($scale >= 1) {// 超过原图大小不再缩略
                    if($target == $source) return $target;
                    $width = $srcWidth;
                    $height = $srcHeight;
                } else {// 缩略图尺寸
                    $width = (int)($srcWidth*$scale);
                    $height = (int)($srcHeight*$scale);
                }
            }

            // 载入原图
            $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
            $srcImg = $createFun($source);

            //创建缩略图
            if ($type != 'gif' && function_exists('imagecreatetruecolor'))
                $thumbImg = imagecreatetruecolor($width, $height);
            else
                $thumbImg = imagecreate($width, $height);

            //如果是gif或png，保证透明效果不失效
            if ('gif' == $type) {
                $colorTransparent = imagecolorallocate($thumbImg, 0, 0, 0);
                imagecolortransparent($thumbImg, $colorTransparent);
                imagetruecolortopalette($thumbImg, true, 256);
            }elseif ('png' == $type) {
                imagealphablending($thumbImg, false);
                $colorTransparent = imagecolorallocatealpha($thumbImg, 0, 0, 0, 0);
                imagefill($thumbImg, 0, 0, $colorTransparent);
                imagesavealpha($thumbImg, true);
            }else if('jpg' == $type || 'jpeg' == $type){//设置JPEG渐进式
                //imageinterlace($thumbImg, 1);//IE不支持，故不推荐
            }

            // 复制图片
            if (function_exists("ImageCopyResampled"))
                imagecopyresampled($thumbImg, $srcImg, 0, 0, $srcX, $srcY, $width, $height, $srcWidth, $srcHeight);
            else
                imagecopyresized($thumbImg, $srcImg, 0, 0, $srcX, $srcY, $width, $height, $srcWidth, $srcHeight);

            // 生成图片
            $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
            if($imageFun=='imagejpeg'){ //jpg图片设置质量为100
                $imageFun($thumbImg, $target,100);
            }else{
                $imageFun($thumbImg, $target);
            }
            imagedestroy($thumbImg);
            imagedestroy($srcImg);
            return $target;
        }
        return false;
    }

    /** 添加水印
     * @param string   $source   原图
     * @param string   $target   生成图（为空或跟原图一样都将是覆盖原图）
     * @param string   $w_img    水印图
     * @param int      $w_pos    水印位置
     * @param int      $w_pos    水印透明度
     */
    static function water($source, $target = '', $w_img = '', $w_pos = 9, $w_pct=100) {
        //生成图为空则是覆盖原图
        if(!$target) $target = $source;
        //检查文件是否存在
        if (!file_exists($source) || !file_exists($w_img))
            return false;
        //图片信息
        $source_info = self::getImageInfo($source);
        $source_w    = $source_info['width'];
        $source_h    = $source_info['height'];
        $water_info   = self::getImageInfo($w_img);
        $width        = $water_info['width'];
        $height       = $water_info['height'];
        //如果图片小于水印图片，不生成图片
        if ($source_w < $width || $source_h < $height)
            return false;
        //建立图像
        $sCreateFun = "imagecreatefrom" . ($source_info['type']=='jpg' ? 'jpeg' : $source_info['type']);
        $source_img = $sCreateFun($source);
        $wCreateFun = "imagecreatefrom" . ($water_info['type']=='jpg' ? 'jpeg' : $water_info['type']);
        $water_img = $wCreateFun($w_img);
        //水印位置
        switch($w_pos) {
            case 1: //顶部居左
                $wx = 5;
                $wy = 5;
                break;
            case 2: //顶部居中
                $wx = ($source_w - $width) / 2;
                $wy = 0;
                break;
            case 3: //顶部居右
                $wx = $source_w - $width;
                $wy = 0;
                break;
            case 4: //中部居中
                $wx = 0;
                $wy = ($source_h - $height) / 2;
                break;
            case 5: //中部居左
                $wx = ($source_w - $width) / 2;
                $wy = ($source_h - $height) / 2;
                break;
            case 6: //中部居右
                $wx = $source_w - $width;
                $wy = ($source_h - $height) / 2;
                break;
            case 7: //底部居左
                $wx = 0;
                $wy = $source_h - $height;
                break;
            case 8: // 底部居中
                $wx = ($source_w - $width) / 2;
                $wy = $source_h - $height;
                break;
            case 9: //底部居右
                $wx = $source_w - $width;
                $wy = $source_h - $height;
                break;
            case 10: //随机位置
                $wx = rand(0,($source_w - $width));
                $wy = rand(0,($source_h - $height));
                break;
            default: //随机位置
                $wx = rand(0,($source_w - $width));
                $wy = rand(0,($source_h - $height));
                break;
        }
        if($water_info['type'] == 'png') {
            imagecopy($source_img, $water_img, $wx, $wy, 0, 0, $width, $height);
        } else {
            imagecopymerge($source_img, $water_img, $wx, $wy, 0, 0, $width, $height, $w_pct);
        }
        $ImageFun = 'Image' . ($source_info['type']=='jpg' ? 'jpeg' : $source_info['type']);
        if($ImageFun=='Imagejpeg'){
            $ImageFun($source_img, $target, 100);
        }else{
            $ImageFun($source_img, $target);
        }
        unset($water_info);
        imagedestroy($water_img);
        unset($source_info);
        imagedestroy($source_img);
        return true;
    }

    // 生成图像验证码
    static function buildImageVerify($length=4, $mode=1, $type='png', $width=48, $height=22, $verifyName='verify') {
        require('String.class.php');
        $randval = String::rand_string($length, $mode);
        $_SESSION[$verifyName] = md5($randval);
        $width = ($length * 10 + 10) > $width ? $length * 10 + 10 : $width;
        if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
            $im = @imagecreatetruecolor($width, $height);
        } else {
            $im = @imagecreate($width, $height);
        }
        $r = Array(225, 255, 255, 223);
        $g = Array(225, 236, 237, 255);
        $b = Array(225, 236, 166, 125);
        $key = mt_rand(0, 3);

        $backColor = imagecolorallocate($im, $r[$key], $g[$key], $b[$key]);//背景色（随机）
        $borderColor = imagecolorallocate($im, 100, 100, 100); //边框色
        $pointColor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));//点颜色

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width - 1, $height - 1, $borderColor);
        $stringColor = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        // 干扰
        for ($i = 0; $i < 10; $i++) {
            $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagearc($im, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $fontcolor);
        }
        for ($i = 0; $i < 25; $i++) {
            $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pointColor);
        }
        for ($i = 0; $i < $length; $i++) {
            imagestring($im, 5, $i * 10 + 5, mt_rand(1, 8), $randval{$i}, $stringColor);
        }
        //@imagestring($im, 5, 5, 3, $randval, $stringColor);
        Image::output($im, $type);
    }

    //会动的验证码
    static function buildAnimateVerify($length=4, $mode=1, $width=48, $height=22, $verifyName='verify') {
        require('String.class.php');
        $randval = String::rand_string($length, $mode);
        $_SESSION[$verifyName] = md5($randval);
        $width = ($length * 10 + 10) > $width ? $length * 10 + 10 : $width;
        for($num=0;$num<10;$num++){
            ob_start();
            $im = @imagecreate($width, $height);
            $r = Array(225, 255, 255, 223);
            $g = Array(225, 236, 237, 255);
            $b = Array(225, 236, 166, 125);
            $key = mt_rand(0, 3);

            $backColor = imagecolorallocate($im, $r[$key], $g[$key], $b[$key]);//背景色（随机）
            $borderColor = imagecolorallocate($im, 100, 100, 100);//边框色
            $pointColor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));//点颜色

            @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
            @imagerectangle($im, 0, 0, $width - 1, $height - 1, $borderColor);
            $stringColor = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
            // 干扰
            for ($i = 0; $i < 10; $i++) {
                $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
                imagearc($im, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $fontcolor);
            }
            for ($i = 0; $i < 25; $i++) {
                $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
                imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pointColor);
            }
            for ($i = 0; $i < $length; $i++) {
                imagestring($im, 5, $i * 10 + 5, mt_rand(1, 8), $randval{$i}, $stringColor);
            }
            imagegif($im);
            imagedestroy($im);
              $imagedata[] = ob_get_contents();
            ob_clean();
        }
        require('GIFEncoder.class.php');
        $gif = new GIFEncoder($imagedata);
        ob_clean();
        header('Content-type:image/gif');
        echo $gif->GetAnimation();
    }

    /** 生成UPC-A条形码
     * @param string   $type       图像格式
     * @param string   $type       图像格式
     * @param string   $lw         单元宽度
     * @param string   $hi         条码高度
     */
    static function UPCA($code, $type='png', $lw=2, $hi=100) {
        static $Lencode = array('0001101', '0011001', '0010011', '0111101', '0100011','0110001', '0101111', '0111011', '0110111', '0001011');
        static $Rencode = array('1110010', '1100110', '1101100', '1000010', '1011100','1001110', '1010000', '1000100', '1001000', '1110100');
        $ends = '101';
        $center = '01010';
        /* UPC-A Must be 11 digits, we compute the checksum. */
        if (strlen($code) != 11) {
            die("UPC-A Must be 11 digits.");
        }
        /* Compute the EAN-13 Checksum digit */
        $ncode = '0' . $code;
        $even = 0;
        $odd = 0;
        for ($x = 0; $x < 12; $x++) {
            if ($x % 2) {
                $odd += $ncode[$x];
            } else {
                $even += $ncode[$x];
            }
        }
        $code.= ( 10 - (($odd * 3 + $even) % 10)) % 10;
        /* Create the bar encoding using a binary string */
        $bars = $ends;
        $bars.=$Lencode[$code[0]];
        for ($x = 1; $x < 6; $x++) {
            $bars.=$Lencode[$code[$x]];
        }
        $bars.=$center;
        for ($x = 6; $x < 12; $x++) {
            $bars.=$Rencode[$code[$x]];
        }
        $bars.=$ends;
        /* Generate the Barcode Image */
        if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
            $im = imagecreatetruecolor($lw * 95 + 30, $hi + 30);
        } else {
            $im = imagecreate($lw * 95 + 30, $hi + 30);
        }
        $fg = ImageColorAllocate($im, 0, 0, 0);
        $bg = ImageColorAllocate($im, 255, 255, 255);
        ImageFilledRectangle($im, 0, 0, $lw * 95 + 30, $hi + 30, $bg);
        $shift = 10;
        for ($x = 0; $x < strlen($bars); $x++) {
            if (($x < 10) || ($x >= 45 && $x < 50) || ($x >= 85)) {
                $sh = 10;
            } else {
                $sh = 0;
            }
            if ($bars[$x] == '1') {
                $color = $fg;
            } else {
                $color = $bg;
            }
            ImageFilledRectangle($im, ($x * $lw) + 15, 5, ($x + 1) * $lw + 14, $hi + 5 + $sh, $color);
        }
        /* Add the Human Readable Label */
        ImageString($im, 4, 5, $hi - 5, $code[0], $fg);
        for ($x = 0; $x < 5; $x++) {
            ImageString($im, 5, $lw * (13 + $x * 6) + 15, $hi + 5, $code[$x + 1], $fg);
            ImageString($im, 5, $lw * (53 + $x * 6) + 15, $hi + 5, $code[$x + 6], $fg);
        }
        ImageString($im, 4, $lw * 95 + 17, $hi - 5, $code[11], $fg);
        /* Output the Header and Content. */
        Image::output($im, $type);
    }

    static function output($im, $type='png', $filename='') {
        ob_clean(); //防止出现'图像因其本身有错无法显示'的问题
        header("Content-type: image/" . $type);
        $ImageFun = 'image' . $type;
        if (empty($filename)) {
            $ImageFun($im);
        } else {
            $ImageFun($im, $filename);
        }
        imagedestroy($im);
    }

}//类定义结束
?>
