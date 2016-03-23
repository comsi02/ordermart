<?php
class Common {
    public static function s3_upload($img, $path){
        $result = [
            'success' => false,
            'message' => 'image object error',
            'filename' => null
        ];

        if (isset($img)) {
            $afinfo = explode('.',$img->getClientOriginalName());
            $s3_file_name = date('Ymd_His_').str_random(10).'.'.end($afinfo);
            $img->move('/tmp/', $s3_file_name);

            $s3 = App::make('aws')->createClient('s3');
            try{
                    $up = $s3->putObject([
                    'ACL' => 'public-read',
                    'Bucket' => env('AWS_S3_BUCKET'),
                    'Key' => $path.$s3_file_name,
                    'SourceFile' => '/tmp/'.$s3_file_name
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
                unlink('/tmp/'.$s3_file_name);
            }
        }
        return $result;
    }
}
