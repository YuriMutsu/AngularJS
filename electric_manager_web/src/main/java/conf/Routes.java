
package conf;


import controllers.LoginLogoutController;
import ninja.AssetsController;
import ninja.Router;
import ninja.application.ApplicationRoutes;
import controllers.ApplicationController;
import service.DienKeService;
import service.KhachHangService;

public class Routes implements ApplicationRoutes {

    @Override
    public void init(Router router) {  
        
        router.GET().route("/").with(ApplicationController::index);
        router.GET().route("/login").with(LoginLogoutController::login);
        router.GET().route("/logout").with(LoginLogoutController::logout);

        router.GET().route("/getKhuVuc").with(ApplicationController::getKhuVuc);
        router.GET().route("/getThanhPho").with(ApplicationController::getThanhPho);
        router.GET().route("/getListKhachHang").with(KhachHangService::getKhachHangStatistic);

        router.POST().route("/deleteKhachHang").with(KhachHangService::deleteKhachHang);

        router.GET().route("/getDienKe").with(DienKeService::getDienKe);
        router.POST().route("/updateChiSoDienKe").with(DienKeService::updateDienKe);
        router.POST().route("/addDienKe").with(DienKeService::addDienKe);
        ///////////////////////////////////////////////////////////////////////
        // Assets (pictures / javascript)
        ///////////////////////////////////////////////////////////////////////    
        router.GET().route("/assets/webjars/{fileName: .*}").with(AssetsController::serveWebJars);
        router.GET().route("/assets/{fileName: .*}").with(AssetsController::serveStatic);
        
        ///////////////////////////////////////////////////////////////////////
        // Index / Catchall shows index page
        ///////////////////////////////////////////////////////////////////////
        router.GET().route("/.*").with(ApplicationController::index);
    }

}
