<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-08-12 09:43:46              |
    |    GitHub: https://github.com/pk-fr/yakpro-po    |
    |__________________________________________________|
*/
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.zcart@gmail.com>, September 2018
*/
 namespace App\Http\Controllers\Installer; use App\Http\Controllers\Installer\Helpers\DatabaseManager; use App\Http\Controllers\Installer\Helpers\InstalledFileManager; use Illuminate\Routing\Controller; class UpdateController extends Controller { use \App\Http\Controllers\Installer\Helpers\MigrationsHelper; public function welcome() { return view("\151\x6e\x73\164\141\x6c\154\x65\x72\56\x75\x70\x64\x61\x74\145\56\167\145\x6c\x63\x6f\x6d\145"); } public function overview() { $migrations = $this->getMigrations(); $dbMigrations = $this->getExecutedMigrations(); return view("\151\x6e\x73\164\141\x6c\x6c\145\162\x2e\x75\x70\x64\141\x74\145\x2e\157\x76\145\162\x76\151\145\167", ["\x6e\x75\x6d\142\145\162\x4f\x66\125\160\x64\x61\x74\145\163\x50\x65\156\144\151\x6e\147" => count($migrations) - count($dbMigrations)]); } public function database() { $databaseManager = new DatabaseManager(); $response = $databaseManager->migrateAndSeed(); return redirect()->route("\x4c\x61\162\141\166\145\154\x55\160\x64\141\x74\x65\x72\x3a\72\146\x69\156\141\154")->with(["\155\x65\163\x73\141\147\x65" => $response]); } public function finish(InstalledFileManager $fileManager) { $fileManager->update(); return view("\151\156\x73\164\x61\x6c\154\x65\x72\x2e\165\x70\x64\141\x74\x65\56\x66\151\156\x69\x73\150\145\x64"); } }
