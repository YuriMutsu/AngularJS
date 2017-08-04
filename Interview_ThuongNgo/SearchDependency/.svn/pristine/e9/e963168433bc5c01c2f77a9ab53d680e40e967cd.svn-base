package handler;

import models.DependencyVO;
import org.apache.log4j.Logger;
import service.ArtifactConvertImpl;
import service.DependencySearcherImpl;
import service.RequestHandler;
import util.Constant;

import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class SearchDependencyHandler {
    private static final Logger m_logger = Logger.getLogger(SearchDependencyHandler.class);
    private DependencySearcherImpl m_dependencySearcherImpl = new DependencySearcherImpl();

    public DependencyVO searchDependency(String binaryName) {
        m_logger.info(String.format("Find all dependencies for combo plug: %s", binaryName));
        HashMap<String, String> artifactIdVersion = m_dependencySearcherImpl.getArtifactIdVersion(binaryName);
        String artifactId = artifactIdVersion.get(Constant.ARTIFACT_ID);
        String version = artifactIdVersion.get(Constant.VERSION);
        String groupIdContent = m_dependencySearcherImpl.getPomContent(artifactId, version);
        ArtifactConvertImpl artifactConvert = new ArtifactConvertImpl();
        String groupId = artifactConvert.getGroupIdFromPomFile(groupIdContent);
        String contentFirstPomFile = m_dependencySearcherImpl.getPomContent(groupId, artifactId, version);
        DependencyVO dependencyVO = artifactConvert.getDependencyVO(contentFirstPomFile);
        return dependencyVO;
    }

    public DependencyVO getDependencySecondLevelInfo(String data) {
        m_logger.info("data: " + data);
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
            String contentSecondPomFile = m_dependencySearcherImpl.getPomContent(groupId, artFactId, version);
            ArtifactConvertImpl artifactConvert = new ArtifactConvertImpl();
            DependencyVO dependencyVO = artifactConvert.getDependencyVO(contentSecondPomFile);
            if(firstRun){
                firstDependencyVO = dependencyVO;
                firstRun = false;
            } else {
                firstDependencyVO.getDependencies().addAll(dependencyVO.getDependencies());
            }
        }
        return firstDependencyVO;
    }

    public static boolean checkNull(DependencyVO dependencyVO) {
        if (dependencyVO.getGroupId() == null && dependencyVO.getArtifactId() == null && dependencyVO.getVersion() == null) {
            return true;
        }
        return false;
    }
}
