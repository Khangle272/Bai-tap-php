<?php
interface Downloadable 
{
    public function download();
}

class book
{
    public $title;
    public $author;
    public $price;

    public function __construct($title, $author, $price)
    {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function xuat()
    {
        echo $this->title . " - " . $this->author . " - $" . $this->price;
    }
}

class ebook extends book implements Downloadable
{
    public $fileSize;

    public function __construct($title, $author, $price, $fileSize)
    {
        parent::__construct($title, $author, $price);
        $this->fileSize = $fileSize;
    }

    public function xuat()
    {
        parent::xuat();
        echo " - Kích thước file: " . $this->fileSize . " MB";
    }

    public function download()
    {
        echo "<br>Đang tải xuống Ebook: '" . $this->title . "' với dung lượng " . $this->fileSize . " MB...";
    }
}

$myEbook = new ebook("Lập trình PHP", "Nguyễn Văn A", 15, 2.5);
$myEbook->xuat();
$myEbook->download();
?>      