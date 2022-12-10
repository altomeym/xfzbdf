<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-08-31 19:46:13              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/

/*
* this file decoded by hassan00942
*/
 namespace App\Services;

 use App\Models\Package;

 use Illuminate\Support\Facades\DB;

 use Illuminate\Http\Request;

 use Illuminate\Support\Arr;

 use Illuminate\Support\Str;

 use Illuminate\Support\Facades\Log;

 use Illuminate\Support\Facades\Artisan;

 use Illuminate\Support\MessageBag;

 
 class PackageInstaller {
    public $package;

    public $slug;

    public $namespace;

    public $path;

    public $migrations;

    public function __construct(Request $request, array $installable) {
        $this->package = array_merge($installable, $request->all());

        $this->slug = $installable["slug"];

        $this->namespace = "\Incevio\Package\\" . Str::studly(Str::replace("-", "_", $this->slug));

        $this->path = $installable["path"];

        $this->migrations = str_replace(base_path(), '', $this->path . "/database/migrations");

    }

    public function install() {
        Log::info("Installing package " . $this->slug);
        try {
            $package_data = array_merge($this->package, preparePackageInstallation($this->package));

            Package::create($package_data);

            $this->migrate()->seed();

        } catch (\Exception $exception) { Log::info("Package installation failed " . $this->slug);
            Log::error(get_exception_message($exception));
            throw new \Exception("Package Installation Failed " . $this->slug);
        }
        Log::info("Successfully installed package " . $this->slug);
        return true;
    }

    private function migrate() {
        Log::info("Migration started for " . $this->slug);
        Artisan::call("migrate", ["--path" => $this->migrations, "--force" => true]);
        Log::info(Artisan::output());
        return $this;
    }

    private function seed() {
        Log::info("Seeding package data for " . $this->slug);
        foreach (glob($this->path . "/database/seeds/*.php") as $filename) {
            $classes = get_declared_classes();
            include $filename;
            $temp = array_diff(get_declared_classes(), $classes);
            $migration = Arr::last($temp, function ($value, $key) {
                return $value !== "Illuminate\Database\Seeder";
            });
            Artisan::call("db:seed", ["--class" => $migration, "--force" => true]);
            Log::info(Artisan::output());
            vpSCZ:
        }
        Sh8Yl:
        return $this;
    }

    public function uninstall()
    {
        // dd("MRM,'");
        Log::info("Uninstalling Package: " . $this->slug);
        $file = $this->path . "/src/Uninstaller.php";
        if (!file_exists($file)) {
            goto z0RvU;
        }
        
        include $file;
        z0RvU:
        
        $class = $this->namespace . "\Uninstaller";
        
        if (class_exists($class)) {
            goto MpJaK;
        }
        
        Log::info("Uninstaller not found in the package dir for " . $this->slug);
        throw new \Exception("Uninstaller not found for the package " . $this->slug);
            
        MpJaK:
        try {
            (new $class())->cleanDatabase();
            $this->rollback();
        }
        catch(\Exception $e) {
            Log::info("Package uninstallation failed: " . $this->slug);
            throw new \Exception("Uninstallation failed: " . $this->slug. " " . $class. $e->getMessage());
        }
        
        Log::info("Successfully uninstalled package " . $this->slug);
        return $this;
    }
            

    private function rollback() {
        
        Log::info("Roll back called...");
        
        $migrations = array_reverse(glob($this->path . "/database/migrations/*_*.php"));
        
        if (!empty($migrations)) {
            goto tef0O;
        }
        
        Log::info("\116o migration to roll back for package " . $this->slug);
        return $this;

        tef0O:
            foreach ($migrations as $filename) {
                $migration = str_replace(".php", '', basename($filename));
                Log::info("Rolling back: " . $migration);
                $row = DB::table("migrations")->where("migration", $migration);
                if ($row->first()) {
                    goto mcIyN;
                }
                Log::info($migration . " was not migrated before, probably it\'s a new migration file.");
                Log::info("Skipping rolled back: " . $migration);
                goto UCmAq;

                mcIyN:
                    $class = Str::studly(implode("_", array_slice(explode("_", $migration), 4)));
                    if (class_exists($class)) {
                        goto afYeI;
                    }
                    include $filename;
                afYeI:
                    (new $class())->down();
                    if ($row->delete()) {
                        goto bMbuW;
                    }
                    Log::info("Rollback FAILED: " . $migration);
                    throw new \Exception("Migration rollback failed: " . $this->slug);
                    goto SSjQa;
                bMbuW:
                    Log::info("Rolled back: " . $migration);
                SSjQa:
                    UCmAq:
            }
            HIxiW:
                Log::info("All migrations has been rolled back for package " . $this->slug);
            return $this;
    }
}