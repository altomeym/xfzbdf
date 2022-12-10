<?php
/*   __________________________________________________
    |  Obfuscated by YAK Pro - Php Obfuscator  2.0.14  |
    |              on 2022-08-31 19:46:26              |
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
namespace App\Http\Controllers\Admin;
use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\PackageInstallationRequest;
use App\Services\PackageInstaller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class PackagesController extends Controller {
    public function index()
    {
        $installables = $this->scanPackages();
        $installs = Package::all();
        return view("admin.packages.index", compact("installables", "installs"));
    }

    public function upload()
    {
        return view("admin.packages._upload");
    }

    public function save(Request $request)
    {
        echo "<pre\76";
        print_r($request->all());
        echo "<pre>";
        exit("end!");
    }

    public function initiate(Request $request, $package)
    {
        if (!(config("app.demo") == true && config("app.debug") !== true))
        {
            goto KCZKz;
        }

        return back()->with("warning", trans("messages.demo_restriction"));

        KCZKz:
            $installable = $this->scanPackages($package);
            if (!$installable)
            {
                goto XzIXk;
            }
            if (!Package::where("slug", $installable["slug"])->first())
            {
                goto wu2GZ;
            }
            return back()->with("error", trans("messages.package_installed_already", ["package" => $package]));
        wu2GZ:
            XzIXk:
                return view("admin.packages._initiate", compact("installable"));
    }
            
    public function install(PackageInstallationRequest $request, $package) {

        goto DjcVz;
        
        if (!(config("app.demo") == true && config("app.debug") !== true)) {
            goto DjcVz;
        }

        return back()->with("warning", trans("messages.demo_restriction"));

        DjcVz:
            $installable = $this->scanPackages($package);
            if (!$installable) {
                goto jIZVy;
            } try {
                $installer = new PackageInstaller($request, $installable);
                $installer->install();
            } catch (\Exception $e) {
                Log::error($e);
                $installer->uninstall();
                $registered = Package::where("slug", $package)->first();
                if (!$registered) {
                    goto YGJ00;
                }
                $registered->delete();
                YGJ00: return back()->with("error", $e->getMessage());
            }
            Artisan::call("cache:clear");
            Artisan::call("route:clear");
            return back()->with("success", trans("messages.package_installed_success", ["package" => $package]));
            
            jIZVy: return back()->with("error", trans("messages.failed"));
        
    }
    
    public function uninstall(Request $request, $package) {

        if (!(config("app.demo") == true && config("app.debug") !== true)) {
            goto WclC2;
        }

        return back()->with("warning", trans("messages.demo_restriction"));

        WclC2:
        $registered = Package::where("slug", $package)->firstOrFail();
        $uninstallable = $this->scanPackages($package);

        DB::beginTransaction();

        try {
            
            $installer = new PackageInstaller($request, $uninstallable);
            
            if (!$installer->uninstall()) {
                goto LplA4;
            }

            Artisan::call("cache:clear");
            Artisan::call("route:clear");

            if (!$registered->delete()) {
                goto M1qFV;
            }

            $msg = trans("messages.package_uninstalled_success", ["package" => $package]);
            DB::commit();
            
            return back()->with("success", $msg);
            
            M1qFV:
                LplA4:
            
        }
        catch(\Exception $e) {
            /*
            * added by hassan00942
            * this condition is added due to rollback during installer
            */
            if($e->getMessage() == "There is no active transaction"){
                return back()->with("error", "Package uninstall and make sure no effect on script");
            }
            DB::rollback();
            // commented by hassan00942
            // Log::error($e);
            // return back()->with("error", "Package uninstall. " . $e->getMessage());
            return back()->with("error", $e->getMessage());
        }

        return back()->with("error", trans("messages.failed"));
    }

    public function activation(Request $request, $package) {
        if (!(config("app.demo") == true && config("app.debug") !== true)) {
            goto LqcbG;
        }
        return response("error", 444);
        LqcbG:
            if (!($registered = Package::where("slug", $package)->first())) {
                goto N1f_P;
            }
            $registered->active = !$registered->active;
            $registered->save();
            Artisan::call("cache:clear");
            return response("success", 200);
        N1f_P:
            $unregistered = $this->scanPackages($package);
            Log::info($unregistered);
            if (!$unregistered) {
                goto MC6Vh;
            }
            $registered = Package::create($unregistered);
        MC6Vh:
            return response("success", 200);
    }

    public function updateConfig(Request $request) {
        if (!updateOptionTable($request)) {
            goto SXmc8;
        }
        Artisan::call("cache:clear");
        return back()->with("success", trans("messages.package_settings_updated"));
        SXmc8:
            return back()->with("error", trans("messages.failed"));
    }

    public function toggleConfig(Request $request, $option) {
        if (!(config("app.demo") == true && config("app.debug") !== true)) {
            goto xA0Tk;
        }
        return response("error", 444);
        xA0Tk:
            if (!DB::table("options")->where("option_name", $option)->update(["option_value" => DB::raw("NOT option_value") ])) {
                goto LNX70;
            }
            Artisan::call("cache:clear");
            return response("success", 200);
        LNX70:
            return response("error", 405);
    }

    private function scanPackages($slug = null) {
        $packages = [];
        foreach (glob(base_path("packages/*"), GLOB_ONLYDIR) as $dir) {
            if (!file_exists($manifest = $dir . "/manifest.json")) {
                goto FnV3I;
            }
            $json = file_get_contents($manifest);
            if (!($json !== '')) {
                goto Kwvlp;
            }
            $data = json_decode($json, true);
            if (!($data === null)) {
                goto jBith;
            }
            throw new \Exception("Invalid manifest.json file at [{$dir}]");
            jBith:
                $data["path"] = $dir;
                if (!($slug && $data["slug"] == $slug)) {
                    goto YO0CH;
                }
                return $data;
            YO0CH:
                $packages[] = $data;
            Kwvlp:
                FnV3I:
                    n06Qc:
        }
        SblGd:
            return $packages;
    }
}
                                                            