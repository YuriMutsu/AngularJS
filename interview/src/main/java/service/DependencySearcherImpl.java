package service;

import org.apache.log4j.Logger;
import util.ConnectionUtil;
import util.Constant;

import java.util.HashMap;
import java.util.regex.Pattern;

import static util.ConnectionUtil.getInstance;

public class DependencySearcherImpl implements DependencySearcher {
    private static final Logger m_logger = Logger.getLogger(DependencySearcherImpl.class);
    private ConnectionUtil connectionUtil;

    public DependencySearcherImpl(){
        this.connectionUtil = getInstance();
    }

    @Override
    public HashMap<String, String> getArtifactIdVersion(String binaryName) {
        HashMap<String, String> mapArtifactIdVersion = new HashMap<>();
        String binaryPattern = "((plugin-combo))-.*\\.bin";
        Pattern pattern = Pattern.compile(binaryPattern);
        if (!pattern.matcher(binaryName).matches()) {
            m_logger.error("Pattern of combo plug is incorrect: " + binaryName);
            return mapArtifactIdVersion;
        }

        binaryName = binaryName.replace(".bin", "");
        if (binaryName.startsWith("plugin-combo")){
            String result[] = binaryName.split("-");
            String artifactId = result[1] + result[2];
            String[] strVersion = result[4].split("_");
            String subStrVersion = strVersion[0].substring(0, strVersion[0].lastIndexOf("."));
            String version = result[3] + "-" + subStrVersion + "_" + strVersion[1] + "-" + result[5];
            m_logger.info("Get info of combo plugin: " + artifactId + " version: " + version);
            mapArtifactIdVersion.put(Constant.ARTIFACT_ID, artifactId);
            mapArtifactIdVersion.put(Constant.VERSION, version);
            m_logger.info("Get artifactId and version by giving binary name: " + mapArtifactIdVersion);
        } else {
            m_logger.warn("The binary file name is incorrect: " + binaryName);
        }
        return mapArtifactIdVersion;
    }

    public String getPomContent(String artifactId, String version) {
        try {
            return connectionUtil.getDataFromURL(String.format(Constant.URL_GET_GROUPID, artifactId, version));
        } catch (Exception e) {
            m_logger.error(String.format("Error with getPomContent: artifactId = %s, version = %s", artifactId, version), e);
        }
        return Constant.EMPTY_STRING;
    }

    public String getPomContent(String groupId, String artifactId, String version) {
        String result = "";
        try {
            groupId = groupId.replaceAll("\\.", "/");
            String namePomFile = artifactId + "-" + version;
            m_logger.info("Url to get content pom file: " + String.format(Constant.URL_GET_CONTENT_POM_FILE, groupId, artifactId, version, namePomFile));
            result = connectionUtil.getDataFromURL(String.format(Constant.URL_GET_CONTENT_POM_FILE, groupId, artifactId, version, namePomFile));
        } catch (Exception e) {
            m_logger.error(String.format("Error with getPomContent: group = %s, artifactId = %s, version = %s",
                    groupId, artifactId, version), e);
        }
        return result;
    }
}
