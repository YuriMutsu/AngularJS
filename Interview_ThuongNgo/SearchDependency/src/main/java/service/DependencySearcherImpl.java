package service;

import org.apache.log4j.Logger;
import util.ConnectionUtil;
import util.Constant;

import java.util.HashMap;
import java.util.regex.Pattern;

/**
 * Created by nnmthuong on 04/26/2017.
 */
public class DependencySearcherImpl implements DependencySearcher {
    private static final Logger m_logger = Logger.getLogger(DependencySearcherImpl.class);
    private ConnectionUtil m_connectionUtil;

    public DependencySearcherImpl() {
        this.m_connectionUtil = getConnectionUtil();
    }

    /**
     * This method is used to get artifactId and version from combo plugins
     * Example: plugin-combo-isam-5.4-1.0_9.6.90-350226.bin
     */
    public HashMap<String, String> getArtifactIdVersion(String binaryName) {
        HashMap<String, String> hashMapArtifactIdVersion = new HashMap<String, String>();
        String binaryPattern = "((plugin-combo))-.*\\.bin";
        Pattern pattern = Pattern.compile(binaryPattern);
        if (!pattern.matcher(binaryName).matches()) {
            m_logger.error("Pattern of combo plug is incorrect: " + binaryName);
            return hashMapArtifactIdVersion;
        }
        binaryName = binaryName.replace(".bin", "");
        if (binaryName.startsWith("plugin-combo")) {
            String[] result = binaryName.split("-");
            String artifactId = result[1] + result[2];
            String[] strVersion = result[4].split("_");
            String subStrVersion = strVersion[0].substring(0, strVersion[0].lastIndexOf("."));
            String version = result[3] + "-" + subStrVersion + "_" + strVersion[1] + "-" + result[5];
            m_logger.info("Get info of combo plugin: " + artifactId + " version: " + version);
            hashMapArtifactIdVersion.put(Constant.ARTIFACT_ID, artifactId);
            hashMapArtifactIdVersion.put(Constant.VERSION, version);
            m_logger.info("Get artifactId and version by giving binary name: " + hashMapArtifactIdVersion);
        } else {
            m_logger.warn("The binary file name is incorrect: " + binaryName);
        }
        return hashMapArtifactIdVersion;
    }

    public String getPomContent(String artifactId, String version) {
        try {
            return m_connectionUtil.getDataFromUrl(String.format(Constant.URL_GET_GROUPID, artifactId, version));
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
            result = m_connectionUtil.getDataFromUrl(String.format(Constant.URL_GET_CONTENT_POM_FILE, groupId, artifactId, version, namePomFile));
        } catch (Exception e) {
            m_logger.error(String.format("Error with getPomContent: group = %s, artifactId = %s, version = %s",
                    groupId, artifactId, version), e);
        }
        return result;
    }

    protected ConnectionUtil getConnectionUtil() {
        return ConnectionUtil.getInstance();
    }


}
