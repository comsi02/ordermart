<?php
class Common {
    public static function get_img_filename($img){
        $afinfo = explode('.',$img->getClientOriginalName());
        $file_name = date('Ymd_His_').str_random(10).'.'.end($afinfo);
        $img->move(env('UPLOAD_PATH'), $file_name);
        return $file_name;
    }

    public static function make_square_img($file_name,$w=100){
        $img_quality = 100;
        $w = 100;
        $dummy_img = Image::make(env('UPLOAD_PATH').$file_name);
        $dummy_img->fit($dummy_img->width(), $dummy_img->width());
        $dummy_img->resize($w, null, function($constraint){
            $constraint->aspectRatio();
        })->sharpen(7);

        $dummy_img->save(env('UPLOAD_PATH').$file_name, $img_quality);
    }

    public static function make_product_img($file_name){
        $img_quality = 100;
        $w = 720;
        $ratio = 16/9;
        $dummy_img = Image::make(env('UPLOAD_PATH').$file_name);
        $dummy_img->fit($dummy_img->width(), intval($dummy_img->width() / $ratio));
        $dummy_img->resize($w, null, function($constraint){
            $constraint->aspectRatio();
        })->sharpen(7);

        $dummy_img->save(env('UPLOAD_PATH').$file_name, $img_quality);
    }

    public static function s3_upload($s3_file_name, $path){
        $result = [
            'success' => false,
            'message' => 'image object error',
            'filename' => null
        ];

        $s3 = App::make('aws')->createClient('s3');

        try{
                $up = $s3->putObject([
                'ACL' => 'public-read',
                'Bucket' => env('AWS_S3_BUCKET'),
                'Key' => $path.$s3_file_name,
                'SourceFile' => env('UPLOAD_PATH').$s3_file_name
            ]);

            if ( strtolower($up) == 'the specified bucket does not exist') :
                $result['message'] = 'bucket does note exist';
            elseif ( strtolower($up) == 'you must specify a non-null value for the body or sourcefile parameters.') :
                $result['message'] = 'sourceFile error';
            else :
                $result['message'] = $path.$s3_file_name;
                $result['success'] = true;
                $result['filename'] = $s3_file_name;
            endif;
        }catch(exception $e){
            $result['message'] = 's3 error';
        }finally{
            unlink(env('UPLOAD_PATH').$s3_file_name);
        }

        return $result;
    }
}
