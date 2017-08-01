package handler;

import models.DependencyVO;
import service.DependencySearcherImpl;
import util.Constant;

import java.util.HashMap;

public class SearchDependencyHandler {
    private DependencySearcherImpl dependencySearcher = new DependencySearcherImpl();

    public DependencyVO searchDependency(String binaryName){
        HashMap<String, String> mapAritifactIdVersion = dependencySearcher.getArtifactIdVersion(binaryName);
        String artifactId = mapAritifactIdVersion.get(Constant.ARTIFACT_ID);
        String version = mapAritifactIdVersion.get(Constant.VERSION);
        String groupIdContent = dependencySearcher.getPomContent(artifactId, version);

        return null;
    }
}
