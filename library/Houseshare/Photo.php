<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo
 *
 * @author marcin
 */
class My_Houseshare_Photo extends My_Houseshare_Abstract_PropertyAccessor {

    protected $_modelName = 'View_Photo';
    const THUMB_WIDTH = 100;
    const THUMB_HEIGHT = 74;
    const THUMBS_DIR_NAME = 'thumbs';

    /**
     * Sets accommodation id. This must be done using this method
     * since directly setting id properties is not allowed.
     *
     * @param int $id  accommodation id
     */
    public function setAccId($id) {
        $this->_properties['acc_id'] = (string) $id;
    }

    public function getFullPath() {
        return $this->_properties['path'] . $this->_properties['filename'];
    }

    /**
     * Create a thumbnail image for image in $imgPath.
     *
     * @param string $imgPath
     * @return bool true if file was resized and saved successflully
     */
    static public function makeThumb($imgPath) {

        if (!file_exists($imgPath)) {
            throw new Zend_Exception("The following file does not exist: $imgPath");
        }

        $pinfo = pathinfo($imgPath);
        $dirName = dirname($pinfo['dirname']);
        $fileName = $pinfo['filename'];
        $fileExt = $pinfo['extension'];

        $thumbDir = $dirName . DIRECTORY_SEPARATOR . self::THUMBS_DIR_NAME;


        if (!file_exists($thumbDir)) {
            mkdir($thumbDir);
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
            return false;
        }

        return true;
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
    
        if ($row instanceof My_Model_Table_Row_Photo) {
            if (file_exists($this->getFullPath())) {
                if (!unlink($this->getFullPath())) {
                    throw new Exception("Failed deleting {$this->path}");
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
        if (in_array('path', $this->_changedProperties)) {
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
