<?php

namespace  frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class XmlUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $xmlFile;

    public function rules()
    {
        return [
            [['xmlFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xml'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->xmlFile->saveAs('../uploads/' . $this->xmlFile->baseName . '.' . $this->xmlFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getdata(){
        $data = simplexml_load_file('../uploads/' . $this->xmlFile->baseName . '.' . $this->xmlFile->extension);
        return $data;
    }

}