<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class ScanFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:file {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan a file for potential security threats using the ClamAV API';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the file path from the command argument
        $filePath = $this->argument('file');

        // Create a new GuzzleHttp client instance
        $client = new Client();

        // Make a POST request to the ClamAV API to scan the file
        $response = $client->request('POST', 'http://www.virustotal.com/vtapi/v2/file/scan', [
            'multipart' => [
                [
                    'name'     => 'apikey',
                    'contents' => env('CLAMAV_API_KEY'), // Set your ClamAV API key in your .env file
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
            ],
        ]);

        // Get the response body
        $responseBody = json_decode($response->getBody(), true);

        // Get the resource URL for the scanned file
        $resourceUrl = $responseBody['resource'];

        // Make a GET request to the ClamAV API to retrieve the scan report
        $response = $client->request('GET', 'http://www.virustotal.com/vtapi/v2/file/report', [
            'query' => [
                'apikey' => env('CLAMAV_API_KEY'), // Set your ClamAV API key in your .env file
                'resource' => $resourceUrl,
            ],
        ]);

        // Get the response body
        $responseBody = json_decode($response->getBody(), true);

        // Check if the file is infected
        if ($responseBody['positives'] > 0) {
            $this->error("The file is infected with {$responseBody['positives']} viruses!");
        } else {
            $this->info('The file is safe!');
        }
    }
}
