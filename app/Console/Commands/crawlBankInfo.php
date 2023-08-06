<?php

namespace App\Console\Commands;

use App\Models\Banks;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class crawlBankInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Craw bank info in viet nam using vietqr API';

    /**
     * Execute the console command.
     */
    function saveExternalImage($imageUrl)
    {
        $response = Http::get($imageUrl);
        if ($response->successful()) {
            $originalFileName = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_BASENAME);
            $saveDirectory = public_path('banks');
            if (!is_dir($saveDirectory)) {
                mkdir($saveDirectory, 0755, true);
            }
            $savePath = $saveDirectory . '/' . $originalFileName;
            file_put_contents($savePath, $response->body());
            $publicPath = asset('banks/' . $originalFileName);

            return $publicPath;
        } else {
            return null;
        }
    }

    public function handle()
    {
        $response = Http::get('https://api.vietqr.io/v2/banks');
        $info = $response->json();
        $blacklist = ['VTLMONEY', 'VNPTMONEY', 'MAFC'];
        $this->info('🎉 ] -> Fetched ' . count($info['data']) - count($blacklist) . ' banks in Vietnam, arigatou VietQR API :D');
        foreach ($info['data'] as $bank)
        {
            if (in_array($bank['code'], $blacklist)) continue;
            $name = str_replace("Ngân hàng TMCP", "NHTMCP", $bank['name']);
            $logopath = $this->saveExternalImage($bank['logo']);
            Banks::updateOrCreate(
                [
                    'code' => $bank['code']
                ],
                [
                    'name' => $name,
                    'logo' => $logopath,
                    'order' => 0,
                    'shortname' => $bank['shortName']
                ]
            );
            $this->info('🙋‍♂️ ] -> Hello, ' . $name);
        }
    }
}
