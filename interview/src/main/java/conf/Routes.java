
package conf;


import ninja.AssetsController;
import ninja.Result;
import ninja.Router;
import ninja.application.ApplicationRoutes;
import controllers.ApplicationController;

public class Routes implements ApplicationRoutes {

    @Override
    public void init(Router router) {  
        
        router.GET().route("/").with(ApplicationController::index);


        router.GET().route("/getDependency").with(ApplicationController::searchDenpendency);
        router.POST().route("/getDependency/getDependencySecondLevelInfo").with(ApplicationController::getDependencySecondLevelInfo);

        router.GET().route("/exportXml").with(ApplicationController::exportFileXml);

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
