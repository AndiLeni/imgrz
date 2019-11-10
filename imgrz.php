<?php

defined('_JEXEC') or die('Restricted access');

class PlgSystemImgRz extends JPlugin
{
    protected $allowedMimeTypes = array('image/jpeg', 'image/png', 'image/gif');


    public function onContentBeforeSave($context, $article, $isNew)
    {
        if ($context == 'com_media.file') {
            // JFactory::getApplication()->enqueueMessage('MY MESSAGE');

            JFactory::getApplication()->enqueueMessage('Object: ' . print_r($article, true));
            JFactory::getApplication()->enqueueMessage('Filepath: ' . $article->filepath);
            JFactory::getApplication()->enqueueMessage('Filetype: ' . $article->type);
            // JFactory::getApplication()->enqueueMessage('Array: ' . $article->filepath);
        }

        return true;
    }

    public function onContentAfterSave($context, $article, $isNew)
    {
        if ($context == 'com_media.file') {
            // JFactory::getApplication()->enqueueMessage('Filepath: ' . $article->filepath);

            if ($article->type == 'image/jpeg' or $article->type == 'image/png') {
                $orig_image = new JImage($article->filepath);
                // 750 will be set accordind to image ratio depending on 1000
                $resized_image = $orig_image->resize(1000, 750, true, JImage::SCALE_INSIDE);
                $resized_image->toFile($article->filepath);
            }
        }
    }
}
