<?php
/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes,$decimals = 2)
{
    $size = ['B','KB','MB','GB','TB','TB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f",$bytes / pow(1024,$factor)).@$size[$factor];
}
/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType){
    return starts_with($mimeType,'image/');
}

/**
 * 为真时返回checked
 * @param $value
 * @return string
 */
function checked($value)
{
    return $value ? 'checked' : '';
}

/**
 * 返回图片完整路径
 * @param null $value
 * @return mixed|null|string
 */
function page_image($value = null)
{
    if (empty($value)) {
        $value = config('blog.page_image');
    }
    if (! starts_with($value,'http') && $value[0] !== '/') {
        $value = config('blog.uploads.webpath').'/'.$value;
    }

    return $value;
}