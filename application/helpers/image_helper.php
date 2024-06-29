<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

use GuzzleHttp\Client;

function upload_image_to_imgur($imagePath, $clientId) {
    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST', 'https://api.imgur.com/3/image', [
            'headers' => [
                'Authorization' => 'Client-ID ' . $clientId,
            ],
            'form_params' => [
                'image' => base64_encode(file_get_contents($imagePath)),
                'type' => 'base64',
                'name' => basename($imagePath),
                'title' => 'Deskripsi gambar',
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['data']['link']; // Mengembalikan URL gambar dari Imgur
    } catch (\Exception $e) {
        // Log the error
        log_message('error', 'Imgur upload error: ' . $e->getMessage());
        return null;
    }
}




