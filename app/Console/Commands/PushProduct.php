<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PushProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:products {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push csv file of products to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '7G');
        set_time_limit(0);
        ignore_user_abort(true);
        ini_set('max_execution_time', '0');
        ini_set('max_input_time', '0');

        $path = $this->arguments()['path'];
        $start = microtime(true);
        $result = $this->start($path);

        if ($result) {
            $resultTime = microtime(true) - $start;
            echo "Продукты успешно добавлены в базу \n";
            echo 'Время выполнения скрипта: ' . $resultTime;
        }

    }

    public function start($path)
    {
        DB::disableQueryLog();
        DB::table('products')->truncate();

        LazyCollection::make(function () use ($path) {
            $handle = fopen($path, 'r');

            while (($line = fgetcsv($handle, 4096)) !== false) {
                $dataString = implode(", ", $line);
                $row = explode(';', $dataString);
                yield $row;
            }

            fclose($handle);
        })
            ->skip(1)
            ->chunk(1000)
            ->each(function (LazyCollection $chunk) {
                $records = $chunk->map(function ($row) {

                    for ($i = 0; $i < 16; $i++) {
                        if (empty($row[$i])) {
                            $row[$i] = '';
                        }
                    }

                    foreach ($row as &$item) {
                        $item = trim($item, '"');
                    }

                    return [
                        'code' => $row[1],
                        'language' => $row[2],
                        'category' => $row[3],
                        'list_price' => $row[4],
                        'price' => $row[5],
                        'quantity' => (int)$row[6],
                        'name' => $row[7],
                        'description' => $row[8],
                        'seo_name' => $row[9],
                        'short' => $row[10],
                        'status' => $row[11],
                        'vendor' => $row[12],
                        'features' => $row[13] . ';' . $row[14] . ';' . $row[15],
                    ];
                })->toArray();

                DB::table('products')->insert($records);
            });

        return true;
    }


}
