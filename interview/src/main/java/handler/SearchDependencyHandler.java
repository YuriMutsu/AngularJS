package handler;

import models.DependencyVO;
import org.apache.log4j.Logger;
import service.ArtifactCoverterImpl;
import service.DependencySearcherImpl;
import util.Constant;

import java.util.HashMap;
import java.util.Map;

public class SearchDependencyHandler {
    Logger logger = Logger.getLogger(SearchDependencyHandler.class);

    private DependencySearcherImpl dependencySearcher = new DependencySearcherImpl();

    public DependencyVO searchDependency(String binaryName){
        HashMap<String, String> mapAritifactIdVersion = dependencySearcher.getArtifactIdVersion(binaryName);
        String artifactId = mapAritifactIdVersion.get(Constant.ARTIFACT_ID);
        String version = mapAritifactIdVersion.get(Constant.VERSION);
        logger.info("ArtifactId : " + artifactId + " ---- " + "Version : " + version);
        String groupIdContent = dependencySearcher.getPomContent(artifactId, version);

        ArtifactCoverterImpl artifactConvert = new ArtifactCoverterImpl();
        String groupId = artifactConvert.getGroupIdFromPomFile(groupIdContent);
        logger.info("GroupId : " + groupId);
        String contentFirstPomFile = dependencySearcher.getPomContent(groupId, artifactId, version);
        DependencyVO dependencyVO = artifactConvert.getDependencyVO(contentFirstPomFile);

        return dependencyVO;
    }

    public DependencyVO getDependencySecondLevelInfo(String data){
        RequestHandler requestHandler = new RequestHandler();
        Map<String, String> hashMap = new HashMap<String, String>();
        hashMap = requestHandler.parseDataFromClient(data);
        String groupId = hashMap.get(Constant.GROUP_ID);
        String artifactId = hashMap.get(Constant.ARTIFACT_ID);
        String version = hashMap.get(Constant.VERSION);
        String[] artifactIds = artifactId.split(",");

        DependencyVO firstDependencyVO = null;

        boolean firstRun = true;
        for (String artFactId : artifactIds) {
            String contentSecondPomFile = dependencySearcher.getPomContent(groupId, artFactId, version);

            ArtifactCoverterImpl artifactConvert = new ArtifactCoverterImpl();
            DependencyVO dependencyVO = artifactConvert.getDependencyVO(contentSecondPomFile);
            if(firstRun){
                firstDependencyVO = dependencyVO;
                firstRun = false;
            } else {
                firstDependencyVO.getM_listDependency().addAll(dependencyVO.getM_listDependency());
            }
        }
        return firstDependencyVO;
    }

    public static boolean checkNull(DependencyVO dependencyVO) {
        if (dependencyVO.getM_groupId() == null && dependencyVO.getM_artifactId() == null && dependencyVO.getM_artifactId() == null) {
            return true;
        }
        return false;
    }
}
