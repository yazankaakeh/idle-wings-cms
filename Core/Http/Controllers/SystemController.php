<?php

namespace Core\Http\Controllers;


use AppLoader;
use Core\Models\Themes;
use Core\Models\TlBlog;
use Core\Models\TlPage;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function activateLicense(Request $request)
    {
        $request->validate([
            'license' => 'required'
        ]);

        $res = AppLoader::createApp($request['license'], false);

        if($res == 'SUCCESS'){
            $latest_version = '1.2.3';
            $this->updateSystemVersion($latest_version);
            $this->updateThemeVersion($latest_version);
            return redirect()->route('core.admin.welcome');
        }

        return $res;
    }

    /**
     * Will clear system  cache
     */
    public function clearSystemCache()
    {
        try {
            cache_clear();
            toastNotification('success', translate('Cache clear successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            toastNotification('error', translate('Cache clear failed'));
        }
    }

    /**
     * Will clear system  cache
     */
    public function clearSystemCacheFromApi()
    {
        try {
            cache_clear();
            return response()->json(
                [
                    'success' => true,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                ]
            );
        }
    }

    // Generate sitemap
    public function generateSitemap()
    {
        ini_set('max_execution_time', 900);
        try {
            $posts = TlBlog::where('is_publish', config('settings.blog_status.publish'))->where('publish_at', '<', currentDateTime())->get();

            $pages = TlPage::where('publish_status', config('default.page_status.publish'))->where('publish_at', '<', currentDateTime())->get();

            Sitemap::create()
                ->add($posts)
                ->add($pages)
                ->writeToFile(public_path('sitemap.xml'));

            return response()->json([
                'message' => translate('Site Map Generated successfully')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => translate('Site Map Generating Failed')
            ], 500);
        }
    }

    public function storePurchaseKey(Request $request)
    {
        $request->validate([
            'license' => 'required'
        ]);

        return  AppLoader::validateApp($request['license']);
    }

    /**
     * Will updated theme versions
     */
    public function updateThemeVersion($updated_version)
    {

        Themes::query()->update(
            [
                'version' => $updated_version
            ]
        );
    }

    /**
     * Will updated system version
     * 
     * @param String $updated version
     */
    public function updateSystemVersion($version)
    {
        $version_setting_id = getGeneralSettingId('system_version');
        $version_data = [
            'settings_id' => $version_setting_id,
            'value' => $version
        ];
        //Delete Exiting value
        DB::table('tl_general_settings_has_values')
            ->where('settings_id', $version_setting_id)
            ->delete();

        //Store new value
        DB::table('tl_general_settings_has_values')
            ->where('settings_id', $version_setting_id)
            ->insert($version_data);
    }
}
