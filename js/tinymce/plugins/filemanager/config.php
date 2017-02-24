<?php 

session_start();
$_SESSION['id_usuario'];
$_SESSION['base_url'];

$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

//$base_url="http://localhost"; //url base of site if you want only relative url leave empty
$base_url= ""; 

//$upload_dir = '/tinymce/source/'; // path from base_url to upload base dir
$upload_dir = $_SESSION['base_url_upload'].'files/'.$_SESSION['id_usuario'].'/';
if (!file_exists($upload_dir)) {
	mkdir($upload_dir, 0777, true);
}

//$current_path = '../../../../source/'; // relative path to dir for upload file
$current_path = '../../../../files/'.$_SESSION['id_usuario'].'/'; // relative path to dir for upload file
if (!file_exists($current_path)) {
	mkdir($current_path, 0777, true);
}

//THUMBNAILS 
//This folder must is out of file folder because should not be seen inside the filemanager
$current_path_thumb = '../../../../thumbs/'.$_SESSION['id_usuario'].'/'; // relative path to dir for thumbnails storage file [only use to images displaying]
if (!file_exists($current_path_thumb)) {
	mkdir($current_path_thumb, 0777, true);
}

$upload_dir_thumb = $_SESSION['base_url_upload'].'thumbs/'.$_SESSION['id_usuario'].'/'; // path from base_url to thumbnails base dir
if (!file_exists($upload_dir_thumb)) {
	mkdir($upload_dir_thumb, 0777, true);
}

echo "upload_dir = $upload_dir <br>";
echo "current_path = $current_path <br>";
echo "current_path_thumb = $current_path_thumb <br>";
echo "upload_dir_thumb = $upload_dir_thumb <br>";


$MaxSizeUpload=100; //Mb

//**********************
//Image resizing config
//*********************
//If you set true $image_resizing the script conver all images uploaded in image_width x image_height resolutions
$image_resizing=false;
$image_width=600;
$image_height=400;

//******************
//Permits config
//******************
$delete_file=true;
$create_folder=true;
$delete_folder=true;


// extensions for filemanager
$ext_img = array('jpg', 'JPG', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx');
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma');
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid');
$ext_misc = array('zip', 'rar',);

$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions

?>
