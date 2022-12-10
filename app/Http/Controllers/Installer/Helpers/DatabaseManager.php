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
 namespace App\Http\Controllers\Installer\Helpers; use Exception; use Illuminate\Database\SQLiteConnection; use Illuminate\Support\Facades\Artisan; use Illuminate\Support\Facades\Config; use Illuminate\Support\Facades\DB; use Symfony\Component\Console\Output\BufferedOutput; class DatabaseManager { public function migrateAndSeed() { $outputLog = new BufferedOutput(); $this->sqlite($outputLog); return $this->migrate($outputLog); } private function migrate($outputLog) { try { Artisan::call("\x6d\151\x67\162\x61\x74\x65", ["\55\55\146\157\162\x63\145" => true], $outputLog); } catch (Exception $e) { return $this->response($e->getMessage(), "\145\162\x72\x6f\x72", $outputLog); } return $this->seed($outputLog); } private function seed($outputLog) { try { Artisan::call("\x64\x62\x3a\163\x65\x65\144", ["\55\x2d\146\x6f\162\143\x65" => true], $outputLog); Artisan::call("\x69\156\x63\145\166\151\157\72\147\x65\x6e\145\x72\x61\164\145\x2d\x6b\x65\x79", ["\x2d\x2d\146\x6f\x72\x63\145" => true], $outputLog); } catch (Exception $e) { return $this->response($e->getMessage(), "\x65\162\162\157\x72", $outputLog); } return $this->response(trans("\151\156\x73\164\141\x6c\x6c\x65\x72\137\x6d\x65\163\163\141\x67\145\163\56\146\151\156\141\x6c\56\146\x69\156\x69\x73\x68\145\144"), "\x73\165\x63\143\145\x73\163", $outputLog); } public function seedDemoData() { ini_set("\155\x61\170\x5f\x65\x78\145\x63\165\164\x69\157\156\137\x74\x69\155\x65", 1200); $outputLog = new BufferedOutput(); try { Artisan::call("\x69\156\143\145\166\x69\157\x3a\x64\145\155\157"); } catch (Exception $e) { return $this->response($e->getMessage(), "\145\162\162\157\162", $outputLog); } return $this->response(trans("\151\x6e\x73\164\141\x6c\154\x65\x72\x5f\x6d\x65\163\x73\x61\147\145\163\x2e\x66\151\156\141\154\56\x66\151\x6e\x69\163\150\x65\144"), "\163\165\x63\x63\x65\163\163", $outputLog); } private function response($message, $status, $outputLog) { return ["\163\164\x61\x74\165\163" => $status, "\155\145\163\x73\141\147\145" => $message, "\144\142\x4f\165\164\160\x75\164\114\x6f\x67" => $outputLog->fetch()]; } private function sqlite($outputLog) { if (!DB::connection() instanceof SQLiteConnection) { goto TEa1Z; } $database = DB::connection()->getDatabaseName(); if (file_exists($database)) { goto qZlvV; } touch($database); DB::reconnect(Config::get("\144\x61\x74\141\x62\x61\x73\x65\56\x64\x65\146\x61\x75\x6c\164")); qZlvV: $outputLog->write("\125\x73\x69\x6e\147\40\123\x71\154\x4c\151\x74\x65\40\x64\x61\x74\x61\142\141\163\145\72\x20" . $database, 1); TEa1Z: } }