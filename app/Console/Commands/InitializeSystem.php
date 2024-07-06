<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitializeSystem extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'init:system {appname} {db} {dbuser} {dbpass}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Initialize system';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    try {
      echo "System setup started!\n\n";
      //code...
      $systemName = $this->argument('appname');
      $dbName = $this->argument('db');
      $dbUsername = $this->argument('dbuser');
      $dbPass = $this->argument('dbpass');
      // Execute the other command for the system setup
      // Clone env file with database
      $source = base_path() . DIRECTORY_SEPARATOR . '.env.example';
      $destination = base_path() . DIRECTORY_SEPARATOR . '.env';
      if(file_exists($destination)) {
        echo "1. Environment file reset successfully!\n";
        unlink($destination);
      }
      if (copy($source, $destination)) {
        // replace database name and password
        echo "2. Environment file clone successfully!\n";
        $newText = file_get_contents($destination);
        if ($systemName) {
          $newText = \Str::replace('Laravel Admin Template', $systemName, $newText); // Replace database name
        }
        if ($dbName) {
          $newText = \Str::replace('laravel_base_template', $dbName, $newText); // Replace database name
        }
        if ($dbUsername) {
          $newText = \Str::replace('root', $dbUsername, $newText); // Replace username
        }
        if ($dbPass) {
          $newText = \Str::replace('Dev@2017', $dbPass, $newText); // Replace password
        }
        echo "3. Environment file set successfully!\n";
        file_put_contents($destination, $newText);
      } else {
        echo "env file can't be auto generate";
      }
      Artisan::call('key:generate');
      echo "4. Key generated!\n";
      // migrate the db file
      Artisan::call('migrate:fresh');
      echo "5. Migration completed!\n";
      // seed the db file
      Artisan::call('db:seed');
      echo "5. Database seeder completed!\n\n";
      echo "System setup completed!\n\n";
    } catch (\Throwable $th) {
      //throw $th;
      echo "Something went wrong!\n\n";
      echo $th->getMessage();
      echo "\n\n";
    }
    return Command::SUCCESS;
  }
}
