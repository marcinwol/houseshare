<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo
 *
 * Note: It is assumed that thumb images should be located in the
 * same folder as forrent/ forsell/ folders.
 *
 * @author marcin
 */
class My_Houseshare_Photo extends My_Houseshare_Abstract_PropertyAccessor {

    protected $_modelName = 'View_Photo';
    const THUMB_WIDTH = 160;
    const THUMB_HEIGHT = 118;
    const IMAGE_WIDTH = 800;
    const IMAGE_HEIGHT = 600;
    public static $THUMBS_DIR_NAME = 'thumbs/';

    public function __construct($id = null) {
        parent::__construct($id);

        // if constant define than use constant
        if (defined('THUMBS_DIR_NAME')) {
            self::$THUMBS_DIR_NAME = THUMBS_DIR_NAME . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * Sets accommodation id. This must be done using this method
     * since directly setting id properties is not allowed.
     *
     * @param int $id  accommodation id
     */
    public function setAccId($id) {
        $this->_properties['acc_id'] = (string) $id;
    }

    /**
     * Sets path id. This must be done using this method
     * since directly setting id properties is not allowed.
     *
     * @param int $id  path id
     */
    public function setPathId($id) {
        $this->_properties['path_id'] = $id;
    }

    public function getFullPath() {
        return $this->_properties['path'] . $this->_properties['filename'];
    }

    /**
     * Get path to the thumb image of a current photo.
     * 
     * Note: It is assumed that thumb images should be located in the
     * same folder as forrent/ forsell/ folders.
     *
     * @return string path to thumb image
     */
    public function getThumbPath() {
        $pinfo = pathinfo($this->getFullPath());

        $dirName = $pinfo['dirname'];
        $baseDirName = basename($pinfo['dirname']);
        $fileName = $pinfo['filename'];
        $fileExt = $pinfo['extension'];

        return $dirName . DIRECTORY_SEPARATOR .  $fileName . '.jpg';
    }

    /**
     * Manual receive and resize of uploaded photo files.
     * 
     * @param array $fileInfo as returned $adapter->getFileInfo() for a given file
     * @param string $outBaseName A basename of a file name to be saved as.
     * @param string $uploadDir Output dir (e.g. forrent) which will be created in image folder if needed.
     * @return string Path to a resized and saved file.
     */
    static public function resizeAndSave($inputImgPath, $destinationDir, $outBaseName = '', $uploadSubDir='') {

        if (!empty($uploadSubDir)) {
            $destinationDir .= DIRECTORY_SEPARATOR . $uploadSubDir;
        }

        if (!file_exists($destinationDir)) {
            if (!mkdir($destinationDir, 0777, true)) {
                throw new Exception("Failure creating $destinationDir folder");
            }
        }

        if (empty($outBaseName)) {
            $fileInfo = pathinfo($inputImgPath);
            $outBaseName = $fileInfo['basename'];
        }

        $newImgPath = $destinationDir . DIRECTORY_SEPARATOR . $outBaseName . '.jpg';

        // resize and save as jpg
        $img = PhpThumbFactory::create($inputImgPath);
        $img->setOptions(array('jpegQuality' => 90));
        $img->resize(self::IMAGE_WIDTH, self::IMAGE_HEIGHT);
        unlink($inputImgPath); // remove tmp file.


        // this will not fork for vfs mock file system.
        //$img->save($newImgPath, 'JPG');
        
        // mnaually format to jpg since it also works for vfs mock file system.
        $imgResource = imagecreatefromstring($img->getImageAsString());
        ob_start();
        imagejpeg($imgResource, null);
        $imgData = ob_get_contents();
        ob_end_clean();

        //  Save file manualy
        $fp = fopen($newImgPath, 'w');
        fwrite($fp, $imgData);
        fclose($fp);

        return $newImgPath;
    }

    /**
     * Create a thumbnail image for image in $imgPath.
     *
     * Note: It is assumed that thumb images should be located in the 
     * same folder as forrent/ forsell/ folders.
     *
     * @param string $imgPath
     * @return string Path to a saved thumbnail file.
     */
    static public function makeThumb($imgPath) {

        if (!file_exists($imgPath)) {
            throw new Zend_Exception("The following file does not exist: $imgPath");
        }

        $pinfo = pathinfo($imgPath);
        $dirName = dirname($pinfo['dirname']);
        $baseDirName = basename($pinfo['dirname']);
        $fileName = $pinfo['filename'];
        $fileExt = $pinfo['extension'];

        $thumbDir = $dirName . DIRECTORY_SEPARATOR . self::$THUMBS_DIR_NAME .
                $baseDirName;


        if (!file_exists($thumbDir)) {
            if (!mkdir($thumbDir, 0777, true)) {
                throw new Exception("Failure creating $thumbDir folder");
            }
        }
        $outImg = $thumbDir . "/$fileName.jpg";

        try {
            $thumb = PhpThumbFactory::create($imgPath);
            $thumb->adaptiveResize(self::THUMB_WIDTH, self::THUMB_HEIGHT);

            // mnaually format to jpg
            $imgResource = imagecreatefromstring($thumb->getImageAsString());
            ob_start();
            imagejpeg($imgResource, null);
            $imgData = ob_get_contents();
            ob_end_clean();

            //  Save file manualy
            $fp = fopen($outImg, 'w');
            fwrite($fp, $imgData);
            fclose($fp);
        } catch (Exception $e) {
            return '';
        }

        return $outImg;
    }

    /**
     * Delete current photo.
     *
     * Note: This will also try to delete (if exisits) image file from the disk.
     *
     * @return int|null number of rows deleted
     */
    public function delete() {
        $model = $this->getModel();
        $row = $model->find($this->photo_id)->current();
     
       // $photoPath = PHOTOS_PATH . '/' . $this->getFullPath();
       // $thumbPath = THUMBS_PATH .'/' . $this->getThumbPath();
        
        $photoPath = $this->getFullPath();
        $thumbPath = $this->getThumbPath();
        
        //var_dump($photoPath,$thumbPath);
        
        if ($row instanceof My_Model_Table_Row_Photo) {
            
            // delete an image
            if (file_exists($photoPath)) {
                if (!unlink($photoPath)) {
                    throw new Exception("Failed deleting {$photoPath}");
                }
            }
            
            // remote thumb image
            if (file_exists($thumbPath)) {
                if (!unlink($thumbPath)) {
                    throw new Exception("Failed deleting {$thumbPath}");
                }
            }
            
            return $row->delete();
        }
        
        return null;
    }

    /**
     * Insert new photo in the database along with its path.
     * There is not update since updating a photo (i.e. changing the photo)
     * is just substitution of files on the hard disk rather than records
     * in database.
     *
     * @return int Primary key of inserted/updated  row
     */
    public function save() {

        // insert path
        if (array_key_exists('path', $this->_changedProperties)) {
            $pathModel = new My_Model_Table_Path();

            $path_id = $pathModel->insertPath(
                            array('path_value' => $this->path)
            );
        } else {
            $path_id = $this->_properties['path_id'];
        }


        // insert photo
        $photo_id = $this->getModel()->insertPhoto(
                        array(
                            'filename' => $this->filename,
                            'path_id' => $path_id,
                            'acc_id' => $this->acc_id
                        )
        );

        $this->_populateProperties($photo_id);

        return $photo_id;
    }

}

?>
