
package conf;


import controllers.SearchDependencyController;
import ninja.AssetsController;
import ninja.Results;
import ninja.Router;
import ninja.application.ApplicationRoutes;
import controllers.ApplicationController;

public class Routes implements ApplicationRoutes {

    @Override
    public void init(Router router) {

        router.GET().route("/").with(ApplicationController::index);
        router.GET().route("/dependency").with(SearchDependencyController::dependency);
        router.GET().route("/dependency/getDependency").with(SearchDependencyController::searchDependency);
        router.POST().route("/dependency/getDependencySecondLevelInfo").with(SearchDependencyController::getDependencySecondLevelInfo);
        router.POST().route("/dependency/exportXML").with(SearchDependencyController::exportXML);

        router.GET().route("/assets/webjars/{fileName: .*}").with(AssetsController::serveWebJars);
        router.GET().route("/assets/{fileName: .*}").with(AssetsController::serveStatic);

        router.GET().route("/.*").with(Results.html().template("views/system/404notFound.ftl.html"));
    }

}
